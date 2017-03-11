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

class SocialloginAccountModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $display_column_left = false;
    public $auth = true;
    private $confirmations = array();

    public function initContent()
    {
        parent::initContent();
        $customer = $this->context->customer;
        require_once($this->module->getLocalPath().'models/SocialLoginModel.php');
        $customer_log = SocialLoginModel::getCustomerLog((int)$customer->id);
        $customer_network = array();
        foreach ($customer_log as $value) {
            $customer_network[] = $value['name'];
        }

        $array_customers = array();
        foreach ($this->module->array_networks as $value) {
            $array_customers[$value] = in_array($value, $customer_network) ? 1 : 0;
        }

        if ((int)Tools::getValue('conf')) {
            $this->confirmations[] = sprintf(
                'Customer connected successfully to %s',
                (Tools::getValue('p') ? Tools::ucfirst(Tools::getValue('p')) : 'Network')
            );
        }

        $this->context->smarty->assign(array(
            'customer_log' => $array_customers,
            'token' => Tools::getToken('sociallogin'),
            'confirmations' => $this->confirmations,
            'network' => pSQL(Tools::getValue('network'))
        ));

        $this->module->prepareCache();

        $this->setTemplate('account.tpl');
    }

    public function postProcess()
    {
        parent::postProcess();
        if ((int)Tools::getValue('delete')) {
            $array_networks = $this->module->array_networks;
            if (($action = pSQL(Tools::getValue('p'))) && in_array($action, $array_networks)) {
                if (($token = pSQL(Tools::getValue('token_delete'))) && $token == Tools::getToken($action)) {
                    include_once(_PS_MODULE_DIR_.$this->module->name.'/models/SocialLoginModel.php');
                    if (SocialLoginModel::deleteConnection($this->context->customer->id, $action)) {
                        $this->confirmations[] = sprintf(
                            'Account connection for %s deleted successfully',
                            $action
                        );
                    } else {
                        $this->errors[] = 'An error ocurred when trying to delete connection';
                    }
                } else {
                    $this->errors[] = 'Error in secure token, impossible to delete connection';
                }
            } else {
                $this->errors[] = 'This network have not connected to your account';
            }
        }
    }
}
