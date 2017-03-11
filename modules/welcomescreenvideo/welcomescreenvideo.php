<?php
/**
* 2007-2015 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2015 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Welcomescreenvideo extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'welcomescreenvideo';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Theme01.com';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('01 Welcome Screen Video');
        $this->description = $this->l('A welcome screen for your homepage with video or image background.');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->module_key = '37001e4d88a7e11972945e8e6eb2b9bd';
    }

    public function install()
    {
        $values = array();

        Configuration::updateValue('WSC_BG_COLOR', '#605157');
        Configuration::updateValue('WSC_IMAGE_URL', _MODULE_DIR_.$this->name.'/views/img/default.jpg');
        Configuration::updateValue('WSC_VIDEO_URL', _MODULE_DIR_.$this->name.'/views/videos/default.mp4');
        Configuration::updateValue('WSC_VIDEO_TYPE', 'video/mp4');
        Configuration::updateValue('WSC_IMAGE_STAMP', time());
        Configuration::updateValue('WSC_VIDEO_STAMP', time());
        Configuration::updateValue('WSC_BL_VIDEO_LOOP', true);
        Configuration::updateValue('WSC_BL_VIDEO_MUTE', true);
        Configuration::updateValue('WSC_MASK_COLOR', '#000000');
        Configuration::updateValue('WSC_MASK_OPACITY', 0.23);
        Configuration::updateValue('WSC_TEXT_COLOR', '#ffffff');
        Configuration::updateValue('WSC_BL_BG_COLOR', true);
        Configuration::updateValue('WSC_BL_BG_IMAGE', true);
        Configuration::updateValue('WSC_BL_BG_VIDEO', true);
        Configuration::updateValue('WSC_BL_MASK', true);
        Configuration::updateValue('WSC_BL_CONTENT', true);
        Configuration::updateValue('WSC_YOUTUBE_VIDEO_ID', false);
        Configuration::updateValue('WSC_VIMEO_VIDEO_ID', false);
        Configuration::updateValue('WSC_CONTENT_H_ALIGN', 'center');
        Configuration::updateValue('WSC_CONTENT_V_ALIGN', 'center');

        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $values['WSC_CONTENT'][(int)$lang['id_lang']] = htmlentities('');
        }

        Configuration::updateValue('WSC_CONTENT', $values['WSC_CONTENT']);

        return parent::install() &&
            $this->registerHook('displayBackOfficeHeader') &&
            $this->registerHook('displayHeader') &&
            $this->registerHook('displayHome');
    }

    public function uninstall()
    {
        Configuration::deleteByName('WSC_BG_COLOR');
        Configuration::deleteByName('WSC_IMAGE_URL');
        Configuration::deleteByName('WSC_VIDEO_URL');
        Configuration::deleteByName('WSC_VIDEO_TYPE');
        Configuration::deleteByName('WSC_IMAGE_STAMP');
        Configuration::deleteByName('WSC_VIDEO_STAMP');
        Configuration::deleteByName('WSC_BL_VIDEO_LOOP');
        Configuration::deleteByName('WSC_BL_VIDEO_MUTE');
        Configuration::deleteByName('WSC_CONTENT');
        Configuration::deleteByName('WSC_MASK_COLOR');
        Configuration::deleteByName('WSC_MASK_OPACITY');
        Configuration::deleteByName('WSC_TEXT_COLOR');
        Configuration::deleteByName('WSC_BL_BG_COLOR');
        Configuration::deleteByName('WSC_BL_BG_IMAGE');
        Configuration::deleteByName('WSC_BL_BG_VIDEO');
        Configuration::deleteByName('WSC_BL_MASK');
        Configuration::deleteByName('WSC_BL_CONTENT');
        Configuration::deleteByName('WSC_YOUTUBE_VIDEO_ID');
        Configuration::deleteByName('WSC_VIMEO_VIDEO_ID');
        Configuration::deleteByName('WSC_CONTENT_H_ALIGN');
        Configuration::deleteByName('WSC_CONTENT_V_ALIGN');

        return parent::uninstall();
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $languages = Language::getLanguages(false);
        $fields = array();

        foreach ($languages as $lang) {
            $fields['WSC_CONTENT'][$lang['id_lang']] = html_entity_decode(Configuration::get('WSC_CONTENT', $lang['id_lang']));
        }

        return array(
            'WSC_BG_COLOR' => Configuration::get('WSC_BG_COLOR', false),
            'WSC_MASK_COLOR' => Configuration::get('WSC_MASK_COLOR', false),
            'WSC_MASK_OPACITY' => Configuration::get('WSC_MASK_OPACITY', false),
            'WSC_TEXT_COLOR' => Configuration::get('WSC_TEXT_COLOR', false),
            'WSC_BL_VIDEO_MUTE' => Configuration::get('WSC_BL_VIDEO_MUTE', false),
            'WSC_BL_VIDEO_LOOP' => Configuration::get('WSC_BL_VIDEO_LOOP', false),
            'WSC_BL_BG_COLOR' => Configuration::get('WSC_BL_BG_COLOR', false),
            'WSC_BL_BG_IMAGE' => Configuration::get('WSC_BL_BG_IMAGE', false),
            'WSC_BL_BG_VIDEO' => Configuration::get('WSC_BL_BG_VIDEO', false),
            'WSC_BL_MASK' => Configuration::get('WSC_BL_MASK', false),
            'WSC_BL_CONTENT' => Configuration::get('WSC_BL_CONTENT', false),
            'WSC_IMAGE_URL' => '',
            'WSC_VIDEO_URL' => '',
            'WSC_CONTENT_V_ALIGN' => Configuration::get('WSC_CONTENT_V_ALIGN', false),
            'WSC_CONTENT_H_ALIGN' => Configuration::get('WSC_CONTENT_H_ALIGN', false),
        ) + $fields;
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        $output = '';
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitWelcomescreenvideoModule')) == true) {
            $output .= $this->postProcess();
        }

        if (file_exists(_PS_MODULE_DIR_.$this->name.'/docs/readme_en.pdf') || file_exists(_PS_MODULE_DIR_.$this->name.'/docs/readme_fr.pdf')) {
            $this->context->smarty->assign('module_dir', $this->_path);
            $output .= $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');
        }

        return $output.$this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitWelcomescreenvideoModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        $video_desc = Configuration::get('WSC_VIDEO_URL').'<br/>';
        if (Configuration::get('WSC_YOUTUBE_VIDEO_ID') != '') {
            $video_desc .= '<span class="wsc_tumb">
                                <iframe width="300" height="168" src="https://www.youtube.com/embed/'.Configuration::get('WSC_YOUTUBE_VIDEO_ID').'"></iframe>
                            </span>';
        } elseif (Configuration::get('WSC_VIMEO_VIDEO_ID') != '') {
            $video_desc .= '<span class="wsc_tumb">
                                <iframe width="300" height="168" src="https://player.vimeo.com/video/'.Configuration::get('WSC_VIMEO_VIDEO_ID').'"></iframe>
                            </span>';
        } else {
            $video_desc .= '<span class="wsc_tumb">
                                <video loop autoplay mute>
                                    <source type="'.Configuration::get('WSC_VIDEO_TYPE').'" src="'.Configuration::get('WSC_VIDEO_URL').'?'.Configuration::get('WSC_VIDEO_STAMP').'"/>
                                </video>
                            </span>';
        };

        return array(
            'form' => array(
                'tinymce' => true,
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Background color'),
                        'name' => 'WSC_BL_BG_COLOR',
                        'required' => false,
                        'is_bool' => true,
                        'desc' => '<span class="jq_toggle_button">'.$this->l('Edit').'</span>',
                        'values' => array(
                            array(
                                'id' => 'bg_color_on',
                                'value' => 1,
                                'label' => $this->l('On')
                            ),
                            array(
                                'id' => 'bg_color_off',
                                'value' => 0,
                                'label' => $this->l('Off')
                            )
                        )
                    ),
                    array(
                        'type' => 'color',
                        'name' => 'WSC_BG_COLOR',
                        'label' => $this->l('Background color'),
                        'size' => 20,
                        'required' => false,
                        'lang' => false,
                        //'desc' => $this->l('Default:').' #605157',
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Background image'),
                        'name' => 'WSC_BL_BG_IMAGE',
                        'required' => false,
                        'is_bool' => true,
                        'desc' => '<span class="jq_toggle_button">'.$this->l('Edit').'</span>',
                        'values' => array(
                            array(
                                'id' => 'bg_image_on',
                                'value' => 1,
                                'label' => $this->l('On')
                            ),
                            array(
                                'id' => 'bg_image_off',
                                'value' => 0,
                                'label' => $this->l('Off')
                            )
                        )
                    ),
                    array(
                        'type' => 'file',
                        'name' => 'WSC_IMAGE_FILE',
                        'label' => $this->l('Upload image file'),
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'WSC_IMAGE_URL',
                        'placeholder' => 'http://',
                        'label' => $this->l('Or set image url'),
                        'class' => 'input_url',
                        'desc' => Configuration::get('WSC_IMAGE_URL').'<br />
                            <span class="wsc_tumb">
                                <img src="'.Configuration::get('WSC_IMAGE_URL').'?'.Configuration::get('WSC_IMAGE_STAMP').'"/>
                            </span>',
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Background video'),
                        'name' => 'WSC_BL_BG_VIDEO',
                        'required' => false,
                        'is_bool' => true,
                        'desc' => '<span class="jq_toggle_button">'.$this->l('Edit').'</span>',
                        'values' => array(
                            array(
                                'id' => 'bg_video_on',
                                'value' => 1,
                                'label' => $this->l('On')
                            ),
                            array(
                                'id' => 'bg_video_off',
                                'value' => 0,
                                'label' => $this->l('Off')
                            )
                        )
                    ),
                    array(
                        'type' => 'file',
                        'name' => 'WSC_VIDEO_FILE',
                        'label' => $this->l('Upload video file'),
                        'hint' => $this->l('File format .mp4, .webm or .ogv'),
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'WSC_VIDEO_URL',
                        'placeholder' => 'http://',
                        'label' => $this->l('Or set video url'),
                        'class' => 'input_url',
                        'desc' => $video_desc,
                        'hint' => $this->l('You can specity the link to your hosted video. Youtube and Vimeo links are accepted'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Mute video'),
                        'name' => 'WSC_BL_VIDEO_MUTE',
                        'required' => false,
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'mute_on',
                                'value' => 1,
                                'label' => $this->l('On')
                            ),
                            array(
                                'id' => 'mute_off',
                                'value' => 0,
                                'label' => $this->l('Off')
                            )
                        )
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Loop video'),
                        'name' => 'WSC_BL_VIDEO_LOOP',
                        'required' => false,
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'loop_on',
                                'value' => 1,
                                'label' => $this->l('On')
                            ),
                            array(
                                'id' => 'loop_off',
                                'value' => 0,
                                'label' => $this->l('Off')
                            )
                        )
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Content'),
                        'name' => 'WSC_BL_CONTENT',
                        'required' => false,
                        'is_bool' => true,
                        'desc' => '<span class="jq_toggle_button">'.$this->l('Edit').'</span>',
                        'values' => array(
                            array(
                                'id' => 'content_on',
                                'value' => 1,
                                'label' => $this->l('On')
                            ),
                            array(
                                'id' => 'content_off',
                                'value' => 0,
                                'label' => $this->l('Off')
                            )
                        )
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->l('Content'),
                        'lang' => true,
                        'name' => 'WSC_CONTENT',
                        'cols' => 40,
                        'rows' => 10,
                        'class' => 'rte',
                        'autoload_rte' => true,
                    ),
                    array(
                        'type' => 'color',
                        'name' => 'WSC_TEXT_COLOR',
                        'label' => $this->l('Text color'),
                        'size' => 20,
                        'required' => false,
                        'lang' => false,
                        'desc' => $this->l('Default:').' #ffffff',
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Vertical alignement'),
                        'name' => 'WSC_CONTENT_V_ALIGN',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id' => 'top',
                                    'name' => $this->l('Top')),
                                array(
                                    'id' => 'center',
                                    'name' => $this->l('Center')),
                                array(
                                    'id' => 'bottom',
                                    'name' => $this->l('Bottom')),
                            ),
                            'id' => 'id',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Horizontal alignement'),
                        'name' => 'WSC_CONTENT_H_ALIGN',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id' => 'left',
                                    'name' => $this->l('Left')),
                                array(
                                    'id' => 'center',
                                    'name' => $this->l('Center')),
                                array(
                                    'id' => 'right',
                                    'name' => $this->l('Right')),
                            ),
                            'id' => 'id',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Mask'),
                        'name' => 'WSC_BL_MASK',
                        'required' => false,
                        'is_bool' => true,
                        'desc' => '<span class="jq_toggle_button">'.$this->l('Edit').'</span>',
                        'values' => array(
                            array(
                                'id' => 'mask_on',
                                'value' => 1,
                                'label' => $this->l('On')
                            ),
                            array(
                                'id' => 'mask_off',
                                'value' => 0,
                                'label' => $this->l('Off')
                            )
                        )
                    ),
                    array(
                        'type' => 'color',
                        'name' => 'WSC_MASK_COLOR',
                        'label' => $this->l('Mask color'),
                        'size' => 20,
                        'required' => false,
                        'lang' => false,
                        'desc' => $this->l('Default:').' #000000',
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'WSC_MASK_OPACITY',
                        'label' => $this->l('Mask opacity'),
                        'size' => 20,
                        'required' => false,
                        'lang' => false,
                        'desc' => $this->l('Default:').' 0.23',
                        'hint' => $this->l('Value between 0 and 1 included')
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $languages = Language::getLanguages(false);
        $values = array();
        $update_content = false;
        $errors = '';
        if (Tools::isSubmit('submitWelcomescreenvideoModule')) {
            if (Tools::isSubmit('WSC_BG_COLOR')) {
                if (Validate::isColor(Tools::getValue('WSC_BG_COLOR'))) {
                    Configuration::updateValue('WSC_BG_COLOR', Tools::getValue('WSC_BG_COLOR'));
                } else {
                    $errors .= ' ' . $this->l('Please enter a valid color code (hex)');
                }
            }

            if (isset($_FILES['WSC_IMAGE_FILE']) && isset($_FILES['WSC_IMAGE_FILE']['tmp_name']) && !empty($_FILES['WSC_IMAGE_FILE']['tmp_name']) && (!Tools::isSubmit('WSC_IMAGE_URL') || Tools::getValue('WSC_IMAGE_URL') == '')) {
                if ($error = ImageManager::validateUpload($_FILES['WSC_IMAGE_FILE'], 4000000)) {
                    $errors .= $error;
                } else {
                    $ext = Tools::substr($_FILES['WSC_IMAGE_FILE']['name'], Tools::strrpos($_FILES['WSC_IMAGE_FILE']['name'], '.') + 1);
                    // Setting the video's name with a name contextual to the shop context.
                    $file_name = 'wsc_background_image';
                    // Creating two versions of the image name, depending on the store context:
                    // If the context is the current group, use the image named 'wsc_background_image-g'
                    // If the context is the current store, use the image named 'wsc_background_image-s'
                    if (Shop::getContext() == Shop::CONTEXT_GROUP) {
                        $file_name = 'wsc_background_image-g'.(int)$this->context->shop->getContextShopGroupID();
                    } elseif (Shop::getContext() == Shop::CONTEXT_SHOP) {
                        $file_name = 'wsc_background_image-s'.(int)$this->context->shop->getContextShopID();
                    }

                    if (!move_uploaded_file($_FILES['WSC_IMAGE_FILE']['tmp_name'], dirname(__FILE__).'/views/upload/'.$file_name.'.'.$ext)) {
                        $errors .= ' ' . $this->l('An error occurred while attempting to upload the image.');
                    } else {
                        $file_path = _MODULE_DIR_.$this->name.'/views/upload/'.$file_name.'.'.$ext;

                        Configuration::updateValue('WSC_IMAGE_STAMP', time());
                        Configuration::updateValue('WSC_IMAGE_URL', $file_path);

                        Tools::redirectAdmin('index.php?tab=AdminModules&conf=6&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
                    }
                }
            }

            if (Tools::isSubmit('WSC_IMAGE_URL') && Tools::getValue('WSC_IMAGE_URL') != '') {
                if (Validate::isAbsoluteUrl(Tools::getValue('WSC_IMAGE_URL'))) {
                    Configuration::updateValue('WSC_IMAGE_STAMP', time());
                    Configuration::updateValue('WSC_IMAGE_URL', Tools::getValue('WSC_IMAGE_URL'));
                } else {
                    $errors .= ' ' . $this->l('Please enter a correct value for image url');
                }
            }

            if (isset($_FILES['WSC_VIDEO_FILE']) && isset($_FILES['WSC_VIDEO_FILE']['tmp_name']) && !empty($_FILES['WSC_VIDEO_FILE']['tmp_name']) && (!Tools::isSubmit('WSC_VIDEO_URL') || Tools::getValue('WSC_VIDEO_URL') == '')) {
                // Setting the video's name with a name contextual to the shop context.
                $vidname = 'wsc_background_video';
                // Creating two versions of the video name, depending on the store context:
                // If the context is the current group, use the video named 'wsc_background_video-g'
                // If the context is the current store, use the video named 'wsc_background_video-s'
                if (Shop::getContext() == Shop::CONTEXT_GROUP) {
                    $vidname = 'wsc_background_video-g'.(int)$this->context->shop->getContextShopGroupID();
                } elseif (Shop::getContext() == Shop::CONTEXT_SHOP) {
                    $vidname = 'wsc_background_video-s'.(int)$this->context->shop->getContextShopID();
                }

                $type = Tools::strtolower(Tools::substr(strrchr($_FILES['WSC_VIDEO_FILE']['name'], '.'), 1));
                $filesize = $_FILES['WSC_VIDEO_FILE']['size'];
                $filetype = $_FILES['WSC_VIDEO_FILE']['type'];
                if (in_array($filetype, array('video/mp4', 'video/webm', 'video/ogg')) && in_array($type, array('mp4', 'webm', 'ogv'))) {
                    if ($filesize < 8388608) {
                        $type = Tools::strtolower(Tools::substr(strrchr($_FILES['WSC_VIDEO_FILE']['name'], '.'), 1));
                        
                        if (!move_uploaded_file($_FILES['WSC_VIDEO_FILE']['tmp_name'], dirname(__FILE__).'/views/upload/'.$vidname.'.'.$type)) {
                            $errors .= ' ' . $this->l('An error occurred during the video upload process.');
                        } else {
                            /* set background video url here */
                            Configuration::updateValue('WSC_VIDEO_URL', $this->_path.'views/upload/'.$vidname.'.'.$type);
                            Configuration::updateValue('WSC_VIDEO_TYPE', $filetype);
                            Configuration::updateValue('WSC_VIDEO_STAMP', time());
                            Configuration::updateValue('WSC_VIMEO_VIDEO_ID', false);
                            Configuration::updateValue('WSC_YOUTUBE_VIDEO_ID', false);
                        }
                    } else {
                        $errors .= ' ' . $this->l('File exceeds maximum size');
                    }
                } else {
                    $errors .= ' ' . $this->l('Please choose a correct video type');
                }
            }

            if (Tools::isSubmit('WSC_VIDEO_URL') && Tools::getValue('WSC_VIDEO_URL') != '') {
                if (Validate::isAbsoluteUrl(Tools::getValue('WSC_VIDEO_URL'))) {
                    $url = Tools::getValue('WSC_VIDEO_URL');
                    $parts = parse_url($url);
                    if ($parts['host'] == 'youtube.com' || $parts['host'] == 'youtu.be' || $parts['host'] == 'www.youtube.com') {
                        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                        Configuration::updateValue('WSC_YOUTUBE_VIDEO_ID', $my_array_of_vars['v']);
                        Configuration::updateValue('WSC_VIMEO_VIDEO_ID', false);
                    } elseif ($parts['host'] == 'vimeo.com' || $parts['host'] == 'www.vimeo.com') {
                        $urlParts = explode("/", parse_url($url, PHP_URL_PATH));
                        $videoId = (int)$urlParts[count($urlParts)-1];
                        Configuration::updateValue('WSC_VIMEO_VIDEO_ID', $videoId);
                        Configuration::updateValue('WSC_YOUTUBE_VIDEO_ID', false);
                    } else {
                        Configuration::updateValue('WSC_YOUTUBE_VIDEO_ID', false);
                        Configuration::updateValue('WSC_VIMEO_VIDEO_ID', false);
                    }

                    Configuration::updateValue('WSC_VIDEO_URL', Tools::getValue('WSC_VIDEO_URL'));
                    Configuration::updateValue('WSC_VIDEO_STAMP', time());
                } else {
                    $errors .= ' ' . $this->l('Please enter a correct value for video url');
                }
            }

            if (Tools::isSubmit('WSC_BL_VIDEO_MUTE')) {
                Configuration::updateValue('WSC_BL_VIDEO_MUTE', (int)Tools::getValue('WSC_BL_VIDEO_MUTE'));
            }

            if (Tools::isSubmit('WSC_BL_VIDEO_LOOP')) {
                Configuration::updateValue('WSC_BL_VIDEO_LOOP', (int)Tools::getValue('WSC_BL_VIDEO_LOOP'));
            }

            foreach ($languages as $lang) {
                if (Tools::isSubmit('WSC_CONTENT_'.$lang['id_lang'])) {
                    if (Validate::isCleanHtml(Tools::getValue('WSC_CONTENT_'.$lang['id_lang']))) {
                        $values['WSC_CONTENT'][$lang['id_lang']] = htmlentities(Tools::getValue('WSC_CONTENT_'.$lang['id_lang']));
                        $update_content = true;
                    } else {
                        $errors .= ' ' . $this->l('Please enter valid HTML for content');
                    }
                }
            }

            if ($update_content) {
                Configuration::updateValue('WSC_CONTENT', $values['WSC_CONTENT']);
            }

            if (Tools::isSubmit('WSC_MASK_COLOR')) {
                if (Validate::isColor(Tools::getValue('WSC_MASK_COLOR'))) {
                    Configuration::updateValue('WSC_MASK_COLOR', Tools::getValue('WSC_MASK_COLOR'));
                } else {
                    $errors .= ' ' . $this->l('Please enter a valid color code (hex)');
                }
            }

            if (Tools::isSubmit('WSC_MASK_OPACITY')) {
                if (Validate::isFloat(Tools::getValue('WSC_MASK_OPACITY')) && Tools::getValue('WSC_MASK_OPACITY') >= 0 && Tools::getValue('WSC_MASK_OPACITY') <= 1) {
                    Configuration::updateValue('WSC_MASK_OPACITY', Tools::getValue('WSC_MASK_OPACITY'));
                } else {
                    $errors .= ' ' . $this->l('Bad value for "Mask opacity"');
                }
            }

            if (Tools::isSubmit('WSC_TEXT_COLOR')) {
                if (Validate::isColor(Tools::getValue('WSC_TEXT_COLOR'))) {
                    Configuration::updateValue('WSC_TEXT_COLOR', Tools::getValue('WSC_TEXT_COLOR'));
                } else {
                    $errors .= ' ' . $this->l('Please enter a valid color code (hex)');
                }
            }

            if (Tools::isSubmit('WSC_BL_BG_COLOR')) {
                Configuration::updateValue('WSC_BL_BG_COLOR', (int)Tools::getValue('WSC_BL_BG_COLOR'));
            }

            if (Tools::isSubmit('WSC_BL_BG_IMAGE')) {
                Configuration::updateValue('WSC_BL_BG_IMAGE', (int)Tools::getValue('WSC_BL_BG_IMAGE'));
            }

            if (Tools::isSubmit('WSC_BL_BG_VIDEO')) {
                Configuration::updateValue('WSC_BL_BG_VIDEO', (int)Tools::getValue('WSC_BL_BG_VIDEO'));
            }

            if (Tools::isSubmit('WSC_BL_CONTENT')) {
                Configuration::updateValue('WSC_BL_CONTENT', (int)Tools::getValue('WSC_BL_CONTENT'));
            }

            if (Tools::isSubmit('WSC_BL_MASK')) {
                Configuration::updateValue('WSC_BL_MASK', (int)Tools::getValue('WSC_BL_MASK'));
            }

            if (Tools::isSubmit('WSC_CONTENT_V_ALIGN')) {
                Configuration::updateValue('WSC_CONTENT_V_ALIGN', Tools::getValue('WSC_CONTENT_V_ALIGN'));
            }

            if (Tools::isSubmit('WSC_CONTENT_H_ALIGN')) {
                Configuration::updateValue('WSC_CONTENT_H_ALIGN', Tools::getValue('WSC_CONTENT_H_ALIGN'));
            }

            if ($errors != '') {
                return $this->displayError($errors);
            } else {
                $this->clearCache();
                return $this->displayConfirmation($this->l('Settings updated'));
            }
        }

        return '';
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('configure') != $this->name) {
            return;
        }

        $this->context->controller->addJquery();
        $this->context->controller->addJS($this->_path.'views/js/back.js');
        $this->context->controller->addCSS($this->_path.'views/css/back.css');
    }

    /**
     * Prepare fo hook
     */
    private function prepareHook()
    {
        $this->smarty->assign('bg_color', Configuration::get('WSC_BG_COLOR'));
        $this->smarty->assign('bg_image_url', Configuration::get('WSC_IMAGE_URL'));
        $this->smarty->assign('bg_image_stamp', Configuration::get('WSC_IMAGE_STAMP'));
        $this->smarty->assign('bg_video_url', Configuration::get('WSC_VIDEO_URL'));
        $this->smarty->assign('youtube_video_id', Configuration::get('WSC_YOUTUBE_VIDEO_ID'));
        $this->smarty->assign('vimeo_video_id', Configuration::get('WSC_VIMEO_VIDEO_ID'));
        $this->smarty->assign('bg_video_type', Configuration::get('WSC_VIDEO_TYPE'));
        $this->smarty->assign('bg_video_stamp', Configuration::get('WSC_VIDEO_STAMP'));
        $this->smarty->assign('bl_video_loop', Configuration::get('WSC_BL_VIDEO_LOOP'));
        $this->smarty->assign('bl_video_mute', Configuration::get('WSC_BL_VIDEO_MUTE'));
        $this->smarty->assign('wsc_content', Configuration::get('WSC_CONTENT', $this->context->language->id));
        $this->smarty->assign('wsc_mask_bgc', $this->hex2rgba(Configuration::get('WSC_MASK_COLOR'), Configuration::get('WSC_MASK_OPACITY')));
        $this->smarty->assign('text_color', Configuration::get('WSC_TEXT_COLOR'));
        $this->smarty->assign('bl_bg_color', Configuration::get('WSC_BL_BG_COLOR'));
        $this->smarty->assign('bl_bg_image', Configuration::get('WSC_BL_BG_IMAGE'));
        $this->smarty->assign('bl_bg_video', Configuration::get('WSC_BL_BG_VIDEO'));
        $this->smarty->assign('bl_content', Configuration::get('WSC_BL_CONTENT'));
        $this->smarty->assign('bl_mask', Configuration::get('WSC_BL_MASK'));
        $this->smarty->assign('v_align', Configuration::get('WSC_CONTENT_V_ALIGN'));
        $this->smarty->assign('h_align', Configuration::get('WSC_CONTENT_H_ALIGN'));


        return true;
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
    }

    public function hookDisplayBanner()
    {
        if (!$this->prepareHook()) {
            return;
        }

        return $this->display(__FILE__, 'welcomescreenvideo.tpl', $this->getCacheId());
    }

    public function clearCache()
    {
        $this->_clearCache('welcomescreenvideo.tpl', $this->getCacheId());
    }

    public function hookHome()
    {
        return $this->hookDisplayBanner();
    }

    /**
     * Convert hexdec color string to rgb(a) string
     */
    public function hex2rgba($color, $opacity = false)
    {
        $default = 'rgb(0,0,0)';

        // Return default if no color provided
        if (empty($color)) {
            return $default;
        }

        // Sanitize $color if "#" is provided
        if ($color[0] == '#') {
            $color = Tools::substr($color, 1);
        }

        // Check if color has 6 or 3 characters and get values
        if (Tools::strlen($color) == 6) {
            $hex = array( $color[0].$color[1], $color[2].$color[3], $color[4].$color[5] );
        } elseif (Tools::strlen($color) == 3) {
            $hex = array( $color[0].$color[0], $color[1].$color[1], $color[2].$color[2] );
        } else {
            return $default;
        }

        // Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        // Check if opacity is set(rgba or rgb)
        if ($opacity || $opacity == 0) {
            if (abs($opacity) > 1) {
                $opacity = 1.0;
            }
            $this->output = 'rgba('.implode(',', $rgb).','.$opacity.')';
        } else {
            $this->output = 'rgb('.implode(',', $rgb).')';
        }

        // Return rgb(a) color string
        return $this->output;
    }
}
