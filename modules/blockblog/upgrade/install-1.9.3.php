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

function upgrade_module_1_9_3($module)
{
	$name_module = 'blockblog';

    // add new values
    Configuration::updateValue($name_module.'blog_com_tr', 75);
    Configuration::updateValue($name_module.'blog_p_tr', 250);
    Configuration::updateValue($name_module.'blog_pl_tr', 140);
    Configuration::updateValue($name_module.'img_size_rp', 'medium_default');
    Configuration::updateValue($name_module.'blog_rp_tr', 75);
    Configuration::updateValue($name_module.'rp_img_width', 150);
    Configuration::updateValue($name_module.'pperpage_com', 3);

    if(version_compare(_PS_VERSION_, '1.6', '>')){
        Configuration::updateValue($name_module.'btabs_type', 1);
    } else {
        Configuration::updateValue($name_module.'btabs_type', 2);
    }


    // update new width
    Configuration::updateValue($name_module.'lists_img_width', 200);
    Configuration::updateValue($name_module.'post_img_width', 500);


    // recreate tabs

    $tab_id = Tab::getIdFromClassName("AdminBlockblog");
    if($tab_id){
        $tab = new Tab($tab_id);
        $tab->delete();
    }

    $tab_id = Tab::getIdFromClassName("AdminBlockblogCategories");
    if($tab_id){
        $tab = new Tab($tab_id);
        $tab->delete();
    }

    $tab_id = Tab::getIdFromClassName("AdminBlockblogPosts");
    if($tab_id){
        $tab = new Tab($tab_id);
        $tab->delete();
    }

    $tab_id = Tab::getIdFromClassName("AdminBlockblogComments");
    if($tab_id){
        $tab = new Tab($tab_id);
        $tab->delete();
    }

    @unlink(_PS_ROOT_DIR_."/img/t/AdminBlockblog.gif");



    $module->createAdminTabs15();

    // recreate tabs




    // add new table in database
    $module->createLikePostTable();


    // add routes only if prestashop > 1.6
    if(version_compare(_PS_VERSION_, '1.6', '>')){
        $module->registerHook('ModuleRoutes');
    }


    ### add field email in ps_blog_category table ####

    $list_fields = Db::getInstance()->executeS('SHOW FIELDS FROM `'._DB_PREFIX_.'blog_category`');
    if (is_array($list_fields))
    {
        foreach ($list_fields as $k => $field)
            $list_fields[$k] = $field['Field'];
        if (!in_array('status', $list_fields)) {
            if (!Db::getInstance(_PS_USE_SQL_SLAVE_)->Execute('ALTER TABLE `' . _DB_PREFIX_ . 'blog_category` ADD `status` int(11) NOT NULL default \'1\'')) {
                return false;
            }

        }
    }


    return true;
}
?>