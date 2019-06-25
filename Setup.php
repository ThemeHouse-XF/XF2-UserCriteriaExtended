<?php

namespace ThemeHouse\UserCriteria;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepResult;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Entity\AddOn;

/**
 * Class Setup
 * @package ThemeHouse\UserCriteria
 */
class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait {
        install as public traitInstall;
    }
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    /**
     * @param array $stepParams
     *
     * @return null|StepResult
     * @throws \XF\PrintableException
     */
    public function install(array $stepParams = [])
    {
        /** @var AddOn $legacyAddOn */
        $legacyAddOn = \XF::em()->find('XF:AddOn', 'KL/UserCriteriaExtended');
        if ($legacyAddOn) {
            $this->db()->delete('xf_addon', "addon_id = 'ThemeHouse/UserCriteria'");
            $legacyAddOn->addon_id = 'ThemeHouse/UserCriteria';
            $legacyAddOn->save();
            return null;
        }

        return $this->traitInstall($stepParams);
    }

    /**
     * @param $previousVersion
     * @param array $stateChanges
     */
    public function postUpgrade($previousVersion, array &$stateChanges)
    {
        if ($previousVersion < 1000200) {
            $this->db()->update('xf_option', [
                'option_value' => 'kl_uce_'
            ], 'option_id = ?', 'thusercriteria_prefix');
        }
    }
}
