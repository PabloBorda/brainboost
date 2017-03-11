<?php
/**
* 2016 Jorge Vargas
*
* NOTICE OF LICENSE
*
* This source file is subject to the End User License Agreement (EULA)
*
* See attachmente file LICENSE
*
* @author    Jorge Vargas <https://addons.prestashop.com/es/Write-to-developper?id_product=17423>
* @copyright 2007-2016 Jorge Vargas
* @link      http://addons.prestashop.com/es/2_community?contributor=3167
* @license   End User License Agreement (EULA)
* @package   sociallogin
* @version   1.0
*/

function autoloaderSocialLogin($class_name)
{
    $dirname = dirname(__FILE__);
    $folders = array(
        'models',
        'classes',
        'libraries'
    );

    foreach ($folders as $folder) {
        $file = "{$dirname}/{$folder}/{$class_name}.php";
        if (is_readable($file)) {
            require_once($file);
            break;
        }
    }
}

spl_autoload_register('autoloaderSocialLogin');
