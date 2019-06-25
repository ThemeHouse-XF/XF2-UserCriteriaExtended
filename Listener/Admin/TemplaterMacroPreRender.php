<?php

namespace ThemeHouse\UserCriteria\Listener\Admin;

use XF\Template\Templater;

/**
 * Class TemplaterMacroPreRender
 * @package ThemeHouse\UserCriteria\Listener\Admin
 */
class TemplaterMacroPreRender
{
    /**
     * @param Templater $templater
     * @param $type
     * @param $template
     * @param $name
     * @param array $arguments
     * @param array $globalVars
     */
    public static function thusercriteriaMacrosAdvancedPane(
        Templater $templater,
        &$type,
        &$template,
        &$name,
        array &$arguments,
        array &$globalVars
    ) {
        $globalVars['trophies'] = \XF::finder('XF:Trophy')->fetch();

        /** @var \XF\Repository\Node $nodeRepo */
        $nodeRepo = \XF::repository('XF:Node');
        $nodes = $nodeRepo->getNodeOptionsData(false, 'Forum', 'option');
        $globalVars['nodes'] = array_map(function ($v) {
            $v['label'] = \XF::escapeString($v['label']);
            return $v;
        }, $nodes);

        $globalVars['reactions'] = \XF::finder('XF:Reaction')->fetch();

        $addonCache = \XF::app()->container('addon.cache');

        if (isset($addonCache['XFRM'])) {
            $globalVars['xfrm_categories'] = \XF::finder('XFRM:Category')->fetch();
        }

        if (isset($addonCache['XFMG'])) {
            $globalVars['xfmg_categories'] = \XF::finder('XFMG:Category')->fetch();
        }
    }
}
