<?php
/**
* 2007-2016 Daniel
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Daniel <contact@examsple.com>
*  @copyright 2007-2016 Daniel
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class HotJar extends Module
{

    private $html = '';

    public function __construct()
    {
        $this->name = 'hotjar';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Daniel P.';
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => _PS_VERSION_);

        $this->need_instance = 0;
        $this->bootstrap = true;

        $this->displayName = $this->l('Hotjar - All-in-one WebShop Analytics and Feedback');
        $this->description = $this->l('Hotjar is a new and easy way to truly understand your shop');
        $this->module_key = '913e1bdc4b150aea735bce3c91b86a90';
        parent::__construct();
    }

    public function install()
    {
        if (
            !parent::install() or
            !$this->registerHook('displayFooter')
            ) {
            return false;
        }
            
        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() or
            !Configuration::deleteByName('HOTJAR_TRACKING_CODE') or
            !Configuration::deleteByName('HOTJAR_SWITCH')
            ) {
            return false;
        }
        return true;
    }

    public function getContent()
    {
        $this->postProcess();
        $this->displayForm();
        return $this->html;
    }


    private function postProcess()
    {
        if (Tools::isSubmit('submitUpdate')) {
            Configuration::updateValue('HOTJAR_TRACKING_CODE', Tools::getValue('trackingcode'), true);
            Configuration::updateValue('HOTJAR_SWITCH', Tools::getValue('theswitch'));

            $this->html .= $this->displayConfirmation($this->l('Settings Updated'));

        }
    }

    public function displayForm()
    {
        $this->html .= $this->generateForm();
    }

    private function generateForm()
    {
        $inputs = array();

        $inputs[] = array(
            'type' => 'switch',
            'label' => $this->l('Enable'),
            'name' => 'theswitch',
            'desc' => 'Choose to enable/disable Hotjar on your website',
            'values' => array(
                array(
                    'id' => 'active_on',
                    'value' => 1,
                    'label' => $this->l('Yes')
                    ),
                array(
                    'id' => 'active_ff',
                    'value' => 0,
                    'label' => $this->l('No')
                    )
                )
            );

        $inputs[] = array(
            'type' => 'textarea',
            'label' => $this->l('Hotjar tracking code'),
            'name' => 'trackingcode',
            'desc' => 'Paste here the Tracking Code from your <a href="https://www.hotjar.com/"
                target="_blank">Hotjar.com</a> account, including the
                <strong><small><em>&lt;script&gt;<em></small></strong> tags.',
            // 'autoload_rte' => true,
            'lang' => false
        );
        
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                    ),
                'input' => $inputs,
                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-default pull-right',
                    'name' => 'submitUpdate'
                    )
                )
            );

        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper = new HelperForm();
        $helper->default_form_language = $lang->id;
        // $helper->submit_action = 'submitUpdate';
        $helper->currentIndex = $this->context->link->getAdminLink(
            'AdminModules',
            false
        ).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
        );
        return $helper->generateForm(array($fields_form));
    }

    public function getConfigFieldsValues()
    {
        // name => value
        return array(
            'trackingcode' => Configuration::get('HOTJAR_TRACKING_CODE'),
            'theswitch' => Configuration::get('HOTJAR_SWITCH')
            );
    }

    public function hookDisplayFooter($params)
    {

        $this->context->smarty->assign(array(
            'code' => Configuration::get('HOTJAR_TRACKING_CODE'),
            'status' => Configuration::get('HOTJAR_SWITCH')
            ));

        return $this->display(__FILE__, 'hotjar.tpl');
    }
}
