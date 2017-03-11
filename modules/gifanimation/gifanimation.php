<?php
/**
* Modulo Gif Animation for Product Sheet
*
* @author    Kijam
* @copyright 2016 Kijam
* @license   Commercial use allowed (Non-assignable & non-transferable), can modify source-code but cannot distribute modifications (derivative works).
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
class GifAnimation extends Module
{
    public function __construct()
    {
        $this->name = 'gifanimation';
        $this->tab = 'front_office_features';
        $this->version = '1.0.1';
        $this->author = 'Kijam';
        $this->module_key = '6e462aea5c06afb3459b5eba36615639';
        
        parent::__construct();

        $this->displayName = $this->l('Gif Animation for Product Sheet');
        $this->description = $this->l('Upload Gif Animation on your product sheet without lose animation');
    }

    public function install()
    {
        if (version_compare(PHP_VERSION, '5.3') < 0) {
            $this->_errors[] = $this->l('This module only work on PHP 5.3 or later.');
            return false;
        }
        if (!extension_loaded('gd')) {
            $this->_errors[] = $this->l('This module requires the GD extension to be loaded.');
            return false;
        }
        if (version_compare(_PS_VERSION_, '1.5.0.15') < 0) {
            $this->_errors[] = $this->l('This module only work on Prestashop 1.5.0.15 or later.');
            return false;
            
        }
        return parent::install();
    }
}
