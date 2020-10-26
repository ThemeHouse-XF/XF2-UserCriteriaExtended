<?php

namespace ThemeHouse\UserCriteria\XF\Admin\Controller;

use XF\Mvc\ParameterBag;

class Tools extends XFCP_Tools
{
    public function actionUserCriteriaTest()
    {
        if ($this->isPost())
        {
            $result = $this->runUserCriteriaTest();
        }
        else
        {
            $result = false;
        }

        $this->setSectionContext('testThUserCriteria');

        $viewParams = [
            'result' => $result,
        ];
        return $this->view('', 'thusercriteria_tools_test', $viewParams);
    }

    protected function runUserCriteriaTest()
    {
        $tester = $this->app->service('ThemeHouse\UserCriteria:Tester');
        return $tester->test();
    }
}