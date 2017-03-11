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

ob_start();
class AdminBlockblogController extends ModuleAdminController
{
    private $_name_controller = 'AdminBlockblogCategories';
    public function __construct()

    {
        $red_url = 'index.php?controller='.$this->_name_controller.'&token='.Tools::getAdminTokenLite($this->_name_controller);
        Tools::redirectAdmin($red_url);
    }

}


?>

