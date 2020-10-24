<?php

namespace ThemeHouse\UserCriteria\Service;

class Tester extends \XF\Service\AbstractService
{
	protected $prefix;
	protected $rulesTested = [];
	protected $rulesFailed = [];

	protected function setup()
	{
		$options = $this->app->options();
		$this->prefix = $options->thusercriteria_prefix;
	}

	public function test()
	{
		$className = 'ThemeHouse\UserCriteria\Listener\CriteriaUser';
		$classCode = $this->getClassCode($className);

		$re = '/case \$prefix\s*\.\s*\'(?<rule>[^\']+)\'\s*:(?<innerCode>.+)break;/Uis';
		preg_match_all($re, $classCode, $matches, PREG_SET_ORDER);

		$testUser = \XF::visitor();

		foreach ($matches as $match)
		{
			$rule = $this->prefix . $match['rule'];
			$innerCode = $match['innerCode'];

			$dataVars = $this->getDataVars($innerCode);
			$data = $this->getTestCriteriaDataForDataVars($dataVars);

			$testCriteria = [
				[
					'rule' => $rule,
					'data' => $data,
				]
			];

			$this->rulesTested[] = $rule;

			$userCriteria = $this->app->criteria('XF:User', $testCriteria);
			$userCriteria->setMatchOnEmpty(false);
			try
			{
				if ($userCriteria->isMatched($testUser))
				{
					// do more testing (possibly later)
				}
			}
			catch (\Exception $e)
			{
				$this->rulesFailed[$rule] = $this->getExceptionHtml($e);
			}
		}

		return [
			'rulesTested' => $this->rulesTested,
			'rulesFailed' => $this->rulesFailed,
		];
	}

	protected function getDataVars($text)
	{
		$re = '/\$data\[(?<prefix>\$prefix\s*\.\s*)?\'(?<dataVar>[^\']+)\'\]/iU';

		preg_match_all($re, $text, $matches, PREG_SET_ORDER);

		$vars = [];

		foreach ($matches as $match)
		{
			$dataVar = $match['dataVar'];
			$hasPrefix = !empty($match['prefix']);

			if ($hasPrefix)
			{
				$dataVar = $this->prefix . $dataVar;
			}

			$vars[$dataVar] = $dataVar;
		}

		return $vars;
	}

	protected function getTestCriteriaDataForDataVars($dataVars)
	{
		$criteria = [];

		$guessVal = function($dataVar)
		{
			$type = null;

			if ($dataVar === 'state')
			{
				$type = 'str';
			}
			else if (substr($dataVar, -4) === '_ids' || in_array($dataVar, ['trophies', 'nodes', 'categories']))
			{
				$type = 'arr';
			}
			else if (strpos($dataVar, 'regex') !== false)
			{
				$type = 'str-regex';
			}

			switch ($type)
			{
				case 'arr':
					return [];
					break;

				case 'str':
					return '';
					break;

				case 'str-regex':
					return '/.+/s';
					break;

				case 'int': // most are int, so fallback on it
				default:
					return 0;
					break;
			}
		};

		foreach ($dataVars as $dataVar)
		{
			$criteria[$dataVar] = $guessVal($dataVar);
		}

		return $criteria;
	}

	protected function getClassCode($className)
	{
		$reflectionClass = new \ReflectionClass($className);

		// run through each criteria and see if any cause errors first
		$method = $reflectionClass->getMethod('criteriaUser');

		$filename = $method->getFileName();
		$startLine = $method->getStartLine() - 1; // it's actually - 1, otherwise you wont get the function() block
		$endLine = $method->getEndLine();
		$length = $endLine - $startLine;

		$source = file($filename);
		$body = implode('', array_slice($source, $startLine, $length));

		return $body;
	}

	protected function getExceptionHtml(\Exception $e)
	{
		$errorView = new \XF\Admin\View\Error\Server($this->app->renderer('html'), $this->app->response(), '', ['exception' => $e]);
		return $errorView->renderHtml();
	}
}