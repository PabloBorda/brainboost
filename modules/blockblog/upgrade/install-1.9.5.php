<?php
/**
 * StorePrestaModules SPM LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 *
/*
 *
 * @author    StorePrestaModules SPM
 * @category content_management
 * @package blockblog
 * @copyright Copyright StorePrestaModules SPM
 * @license   StorePrestaModules SPM
 */

function upgrade_module_1_9_5($module)
{

    if(version_compare(_PS_VERSION_, '1.6', '>')) {
        $module->registerHook('blogCategoriesSPM');
        $module->registerHook('blogPostsSPM');
        $module->registerHook('blogCommentsSPM');
    }


    return true;
}
?>