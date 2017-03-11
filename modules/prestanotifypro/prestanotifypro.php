<?php

if (defined('_PS_VERSION_') === false) {
    exit;
}

if (!class_exists('TinyCache')) {
    include_once dirname(__FILE__).'/classes/TinyCache.php';
}

if (!class_exists('PrestanotifyNotification')) {
    include_once dirname(__FILE__).'/classes/PrestanotifyNotification.php';
}

class prestanotifypro extends Module
{
    /**
     * @var string Admin Module template path
     *             (eg. '/home/prestashop/modules/module_name/views/templates/admin/')
     */
    protected $admin_tpl_path = null;

    /**
     * @var string Admin Module template path
     *             (eg. '/home/prestashop/modules/module_name/views/templates/hook/')
     */
    protected $hooks_tpl_path = null;

    /** @var string Module js path (eg. '/shop/modules/module_name/js/') */
    protected $js_path = null;

    /** @var string Module css path (eg. '/shop/modules/module_name/css/') */
    protected $css_path = null;

    /** @var protected array cache filled with lang informations */
    protected static $lang_cache;

    /** @var string Module css path (eg. '/shop/modules/module_name/css/') */
    protected $sql_path = null;

    /** @var string Module img path (eg. '/shop/modules/module_name/img/') */
    protected $img_path = null;

    /** @var string Module img content path (eg. '/shop/modules/module_name/img/content') */
    protected $img_content_path = null;

    /** @var protected string cache filled with informations */
    protected $cache_path;

    private $post_errors = array();

    /** @var static for memorise the last images total count when calling getImages() */
    public static $last_img_total_count = 0;

    /** SQL files */
    const INSTALL_SQL_FILE = 'install.sql';
    const UNINSTALL_SQL_FILE = 'uninstall.sql';

    public function __construct()
    {
        $this->name = 'prestanotifypro';
        $this->tab = 'advertising_marketing';
        $this->version = '1.2.0';
        $this->author = 'PrestaShop';
        $this->need_instance = '0';
        $this->module_key = '355230a14977e641ee7151c001faaf6b';

        $this->id_shop = Context::getContext()->shop->id;

        $this->bootstrap = true;
        $this->secure_key = Tools::encrypt($this->name);

        parent::__construct();

        $this->displayName = $this->l('Pop Promo');
        $this->description = $this->l('Module for managing notifications on your shop');

        $this->js_path = $this->_path.'js/';
        $this->css_path = $this->_path.'css/';
        $this->sql_path = $this->local_path.'sql/';
        $this->admin_tpl_path = $this->local_path.'views/templates/admin/';
        $this->hooks_tpl_path = $this->local_path.'views/templates/hook/';
        $this->img_path = $this->_path.'img/';
        $this->img_content_path = $this->local_path.'img/content/';
        $this->cache_path = $this->local_path.'cache/';

        // $this->context->smarty->template_dir = $this->admin_tpl_path;

        TinyCache::setPath($this->cache_path);
        if ($this->getCacheRights()) {
            $this->getLang();
        }
    }

    /**
     * Get Language.
     *
     * @return array Lang
     */
    private function getLang()
    {
        $cache = TinyCache::getCache('language', 15, 'minutes');
        if (!empty($cache)) {
            self::$lang_cache = TinyCache::getCache('language', 15, 'minutes');

            return;
        }

        if (self::$lang_cache === null) {
            if (($languages = Language::getLanguages())) {
                foreach ($languages as $row) {
                    $exprow = explode(' (', $row['name']);
                    $subtitle = (isset($exprow[1]) ? trim(Tools::substr($exprow[1], 0, -1)) : '');
                    self::$lang_cache[$row['iso_code']] = array(
                        'id' => (int) $row['id_lang'],
                        'title' => trim($exprow[0]),
                        'subtitle' => $subtitle,
                    );
                }
                // Cache Data
                TinyCache::setCache('language', self::$lang_cache);
                // Clean memory
                unset($row, $exprow, $subtitle, $languages);
            }
        }
    }

    /**
     * Insert module into datable.
     *
     * @return bool result
     */
    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        // Clean up cache
        TinyCache::clearAllCache();

        if (parent::install() === false
            || $this->registerHook('displayHeader') === false
            || $this->registerHook('displayFooter') === false
            || $this->registerActionHooks() === false
            || $this->installSQL() === false
            || $this->installTab() === false
        ) {
            return false;
        }

        //rights on folders
        @chmod($this->img_content_path, 0777);
        @chmod($this->cache_path, 0777);

        return true;
    }

    /**
     * Delete module from datable.
     *
     * @return bool result
     */
    public function uninstall()
    {
        if (parent::uninstall() === false
            || $this->uninstallSQL() === false
            || $this->uninstallTab() === false
        ) {
            return false;
        }

        return true;
    }

    /**
     * Install Tab.
     *
     * @return bool
     */
    private function installTab()
    {
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'AdminPrestanotifypro';
        $tab->name = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = $this->displayName;
        }
        unset($lang);
        $tab->id_parent = -1;
        $tab->module = $this->name;

        return $tab->add();
    }

    /**
     * Uninstall Tab.
     *
     * @return bool
     */
    private function uninstallTab()
    {
        $id_tab = (int) Tab::getIdFromClassName('AdminPrestanotifypro');
        if ($id_tab) {
            $tab = new Tab($id_tab);
            if (Validate::isLoadedObject($tab)) {
                return $tab->delete();
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * Register action hook for >1.5 stores.
     *
     * @return bool result
     */
    private function registerActionHooks()
    {
        if (
            $this->registerHook('actionObjectLanguageAddAfter') === false
            || $this->registerHook('actionObjectLanguageUpdateAfter') === false
            || $this->registerHook('actionObjectLanguageDeleteAfter') === false
        ) {
            return false;
        }

        return true;
    }

    /**
     * Install SQL.
     *
     * @return bool
     */
    private function installSQL()
    {
        // Create database tables from install.sql
        if (!file_exists($this->sql_path.self::INSTALL_SQL_FILE)) {
            return false;
        }

        if (!$sql = Tools::file_get_contents($this->sql_path.self::INSTALL_SQL_FILE)) {
            return false;
        }

        $replace = array(
            'PREFIX' => _DB_PREFIX_,
            'ENGINE_DEFAULT' => _MYSQL_ENGINE_,
        );
        $sql = strtr($sql, $replace);
        $sql = preg_split("/;\s*[\r\n]+/", $sql);

        foreach ($sql as &$q) {
            if ($q && count($q) && !Db::getInstance()->Execute(trim($q))) {
                return false;
            }
        }

        // Clean memory
        unset($sql, $q, $replace);

        return true;
    }

    /**
     * Uninstall SQL.
     *
     * @return bool
     */
    private function uninstallSQL()
    {
        // Create database tables from uninstall.sql
        if (!file_exists($this->sql_path.self::UNINSTALL_SQL_FILE)) {
            return false;
        }

        if (!$sql = Tools::file_get_contents($this->sql_path.self::UNINSTALL_SQL_FILE)) {
            return false;
        }

        $replace = array(
            'PREFIX' => _DB_PREFIX_,
            'ENGINE_DEFAULT' => _MYSQL_ENGINE_,
        );
        $sql = strtr($sql, $replace);
        $sql = preg_split("/;\s*[\r\n]+/", $sql);

        foreach ($sql as &$q) {
            if ($q && count($q) && !Db::getInstance()->Execute(trim($q))) {
                return false;
            }
        }
        // Clean memory
        unset($sql, $q, $replace);

        return true;
    }

    /**
     * Get, check and saved posted settings on Module panel formular.
     */
    private function preProcess()
    {
        $cache_files = scandir($this->cache_path);
        foreach ($cache_files as $file) {
            if (Tools::substr($file, 0, 19) != 'front_notification_') {
                continue;
            }

            unlink($this->cache_path.$file);

            if (file_exists($this->cache_path.$file)) {
                $this->post_errors[] = $this->cache_path.$file;
            }
        }

        if (isset($_COOKIE['prestanotifypro'])) {
            setcookie('prestanotifypro', '', 0, '/');
        }

        if (!empty($this->post_errors)) {
            return $this->displayErrors();
        }
        $this->smarty->assign(array('clearcache' => true));
    }

    public function displayCookieError($current_host, $main_host)
    {
        $this->smarty->assign(array('cookie_error' => true,
            'current_host' => $current_host,
            'main_host' => $main_host, )
        );
    }

    /**
     * Loads asset resources.
     */
    public function loadAsset()
    {
        $css_compatibility = $js_compatibility = $css = array();

        $return = '';

        // Load CSS
        $css = array(
            $this->css_path.'bootstrap-select.min.css',
            $this->css_path.'shadowbox/shadowbox.css',
            $this->css_path.'faq.css',
            );

        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            $css_compatibility = array(
                $this->css_path.'bootstrap.min.css',
                $this->css_path.'bootstrap-responsive.min.css',
                $this->css_path.'DT_bootstrap.css',
                $this->css_path.'font-awesome.min.css',
                $this->css_path.'bootstrap.extend.css',
                $this->css_path.$this->name.'.css',
                _PS_JS_DIR_.'jquery/plugins/timepicker/jquery-ui-timepicker-addon.css',

            );

            $css = array_merge($css, $css_compatibility);
        }

        $this->context->controller->addCSS($css, 'all');

        // Load JS
        $js = array(
            $this->js_path.'bootstrap-select.min.js',
            $this->js_path.'bootstrap-dialog.js',
            $this->js_path.'jquery.autosize.min.js',
            $this->js_path.'jquery.dataTables.js',
            $this->js_path.'jquery.form.min.js',
            $this->js_path.'DT_bootstrap.js',
            $this->js_path.'dynamic_table_init.js',
            $this->js_path.'shadowbox/shadowbox.js',
            $this->js_path.$this->name.'.js',
            $this->js_path.'faq.js', // FAQ js
        );

        // Jquery is required
        if (method_exists($this->context->controller, 'addJquery')) {
            $this->context->controller->addJqueryUI('ui.tabs');
            $this->context->controller->addJquery('2.1.0', $this->js_path);
        }

        if (version_compare(_PS_VERSION_, '1.5', '>=') && (version_compare(_PS_VERSION_, '1.6', '<'))) {
            $this->context->controller->addJqueryUI('ui.datepicker');
            $this->context->controller->addJqueryUI('ui.slider');
            // $this->context->controller->addJqueryPlugin('timepicker');

            $js_compatibility = array(
                $this->js_path.'bootstrap.min.js',
                _PS_JS_DIR_.'jquery/plugins/timepicker/jquery-ui-timepicker-addon.js',
            );
            $js = array_merge($js_compatibility, $js);
        }

        $this->context->controller->addJS($js);

        // Clean memory
        unset($js, $css, $js_compatibility, $css_compatibility);

        return $return;
    }

    /**
     * Format the output errors.
     */
    private function displayErrors()
    {
        if (!empty($this->post_errors)) {
            $this->smarty->assign(array('config_warnings' => $this->post_errors));
        }
    }

    /**
     * Show the configuration module.
     */
    public function getContent()
    {
        $return = '';

        if ($this->context->mode >= 4) { // Means user is on Prestashop Cloud
            $main_host = Db::getInstance()->getValue('SELECT domain FROM '._DB_PREFIX_.'shop_url WHERE active = 1 AND main = 1');
            $current_host = Tools::getHttpHost();
            if ($current_host != $main_host) {
                $return .= $this->displayCookieError($current_host, $main_host);
            }
        }

        // We load asset
        $assets = $this->loadAsset();
        $this->smarty->assign(array('submit' => false));

        // PostProcess
        if (Tools::getValue('ClearCache')) {
            $this->smarty->assign(array('submit' => true));
            $this->preProcess();
        }

        $controller_name = 'AdminPrestanotifypro';
        $admin_token = '&token='.Tools::getAdminTokenLite($controller_name);
        $controller_url = 'index.php?tab='.$controller_name.$admin_token;

        // Clean the code use tpl file for html
        $tab = '&tab_module='.$this->tab;
        $token_mod = '&token='.Tools::getAdminTokenLite('AdminModules');
        $token_pos = '&token='.Tools::getAdminTokenLite('AdminModulesPositions');
        $token_trad = '&token='.Tools::getAdminTokenLite('AdminTranslations');
        $controller = 'controller';

        // Rights verifications for cache/ directory.
        if (!($this->getCacheRights())) {
            $alert_right = $this->displayError($this->l(':( It seems that you are not allowed to write to some files. Be sure that you have the necessary permissions configured on your server.').'
			<br /><br/>

			'.$this->l('In order to change file rights on your server, using your FTP details, go to modules/prestanotifypro and then, check that rights are set to 0777 to rewrite cache file (right click > properties > Permissions > select recursive permissions).'));
            $this->context->smarty->assign(array(
            'rights_alert' => $alert_right,
            ));
        }

        // Display purpose
        $uncinq = false;
        if (version_compare(_PS_VERSION_, '1.5', '>=') && version_compare(_PS_VERSION_, '1.6', '<')) {
            $uncinq = true;
        }
        $this->context->smarty->assign(array('uncinq' => $uncinq));

        // Language part
        $lang = 'EN';
        if ($this->context->language->iso_code == 'fr') {
            $lang = 'FR';
        }
        $emp_lang = $this->context->employee->id_lang;

        $this->context->smarty->assign(array(
            'img_path' => $this->img_path,
            'emp_lang' => $emp_lang,
            'lang_select' => self::$lang_cache,
            'module_active' => (bool) $this->active,
            'module_trad' => 'index.php?'.$controller.'=AdminTranslations'.$token_trad.'&type=modules&lang=',
            'module_hook' => 'index.php?'.$controller.'=AdminModulesPositions'.$token_pos.'&show_modules='.$this->id,
            'module_back' => 'index.php?'.$controller.'=AdminModules'.$token_mod.$tab.'&module_name='.$this->name,
            'module_form' => 'index.php?'.$controller.'=AdminModules&configure='.$this->name.$token_mod.$tab.'&module_name='.$this->name,
            'module_reset' => 'index.php?'.$controller.'=AdminModules'.$token_mod.'&module_name='.$this->name.'&reset'.$tab,
            'module_name' => $this->name,
            'module_version' => $this->version,
            'module_display' => $this->displayName,
            'guide_link' => 'docs/'.$this->name.'_'.$lang.'.pdf',
            'ps_version' => (bool) version_compare(_PS_VERSION_, '1.6', '>'),
            'table_tpl_path' => '../table/table.tpl',
            'controller_url' => $controller_url,
            'controller_name' => $controller_name,
            'multishop' => Shop::isFeatureActive(),
            'default_lang' => (int) $this->context->language->id,
        ));

        // Clean memory
        unset($tab, $token_mod, $token_pos, $token_trad);

        $return .= $assets;

        $return .= $this->display(__FILE__, 'views/templates/admin/configuration.tpl');

        return $return;
    }

    /**
     * Simply verifies if the cache directory has the proper rights
     * return true or false.
     */
    private function getCacheRights()
    {
        $cache_rights = Tools::substr(sprintf('%o', fileperms(dirname(__FILE__).'/cache/')), -3);
        if ($cache_rights == '777') {
            return true;
        }

        return false;
    }

    /**
     * Load the status of a rule with an icon.
     *
     * @param int $status
     *
     * @return html
     */
    public function loadStatus($row, $role, $type)
    {
        switch ($role) {
            case 'images':
                $row_id = $row['image'];
            break;
            default:
                $row_id = $row['id_notification'];
            break;
        }

        $this->context->smarty->assign(array(
            'status' => $row['active'],
            'row_id' => $row_id,
            'role' => $role,
            'type' => $type,
        ));

        return $this->display(__FILE__, 'views/templates/admin/table/status.tpl');
    }

    /**
     * Load action buttons that apply, modify or delete the rule.
     *
     * @param array  $row
     * @param string $type
     * @param string $role
     *
     * @return html
     */
    public function loadActions($row, $role, $type)
    {
        $lang_select = self::$lang_cache;

        switch ($role) {
            case 'images':
                $row_id = $row;
            break;
            default:
                $row_id = $row['id_notification'];
            break;
        }

        $this->context->smarty->assign(array(
            'role' => $role,
            'type' => $type,
            'row_id' => $row_id,
            'lang_select' => $lang_select,
        ));

        return $this->display(__FILE__, 'views/templates/admin/table/actions.tpl');
    }

    /**
     * Load preview column.
     *
     * @param array  $actions
     * @param string $type
     * @param string $role
     *
     * @return html
     */
    public function loadPreview($row, $role, $type)
    {
        $lang_select = self::$lang_cache;

        switch ($role) {
            case 'images':
                $row_id = $row;
            break;

            default:
                $row_id = $row['id_notification'];
            break;
        }

        $this->context->smarty->assign(array(
            'role' => $role,
            'type' => $type,
            'row_id' => $row_id,
            'lang_select' => $lang_select,
            'default_lang' => (int) $this->context->language->id,
            'default_lang_iso' => Language::getIsoById((int) $this->context->language->id),
        ));

        return $this->display(__FILE__, 'views/templates/admin/table/preview.tpl');
    }

    /**
     * Get icon.
     *
     * @param string $type
     * @param object $obj
     *
     * @return html
     */
    public function getIcon($type, $obj = null)
    {
        if ($type === 'flag') {
            $this->context->smarty->assign(array(
                'obj' => $obj,
                'lang_img' => _PS_IMG_.'/l/'.$obj.'.jpg',
            ));
        }
        $this->context->smarty->assign(array(
            'type' => $type,
        ));

        return $this->display(__FILE__, 'views/templates/admin/table/icons.tpl');
    }

    /**
     * Load the form template file.
     *
     * @param int    $id_object
     * @param string $role
     * @param string $type
     *
     * @return html
     */
    public function loadForm($id_object, $role, $type = 'image')
    {
        switch ($role) {
            case 'notif':
                $notification = '';
                if ((int) $id_object > 0) {
                    $notification = new PrestanotifyNotification($id_object);
                    if (!$notification->id) {
                        $notification->id = 0;
                    }
                }

                $this->context->smarty->assign(array(
                    'obj' => $notification,
                    'type' => $type,
                    'images' => $this->getImages(),
                    'lang_select' => self::$lang_cache,
                    'default_lang' => (int) $this->context->language->id,
                ));
                unset($notification);

                return $this->display(__FILE__, 'views/templates/admin/forms/forms_'.$role.'.tpl');
            break;
            case 'upload':

                $this->context->smarty->assign(array(
                    'max_filesize' => $this->getServerMaxUpload(),
                    'lang_select' => self::$lang_cache,
                    'default_lang' => (int) $this->context->language->id,
                ));

                return $this->display(__FILE__, 'views/templates/admin/forms/forms_'.$role.'.tpl');
            break;
        }
    }

    /**
     * Get server's upload max sizefile
     * return int.
     */
    public function getServerMaxUpload()
    {
        $one = Tools::substr(ini_get('post_max_size'), 0, -1);
        $two = Tools::substr(ini_get('upload_max_filesize'), 0, -1);

        if ($one > $two) {
            return $two;
        }

        return $one;
    }

    /** Function to Preview notification on Backoffice, per language.
     * $id_object is the notification id
     * $lang is the notif lang we wanna preview
     * $type is the notification type.
     */
    public function loadNotifPreview($id_object, $lang, $type = 'image')
    {
        $notification = new PrestanotifyNotification((int) $id_object);
        $no_file = $this->DisplayError($this->l('The notification doesnt have an image for this language. Please review the notification settings.'));

        if ($notification->type == 'image') {
            // $this->img_path isn't working so dirname(__file__)
            if (!($notification->getAttribute('image', (int) $lang)) or !(file_exists($this->img_content_path.(int) $lang.'/'.$notification->getAttribute('image', (int) $lang)))) {
                $this->context->smarty->assign(array('no_file' => $no_file));
            } else {
                $this->context->smarty->assign(array(
                'prestanotifypro_img_path' => $this->img_path.'content/'.(int) $lang.'/',
                'shadow_box_content' => $notification->getAttribute('image', (int) $lang),
                'shadow_box_content_link' => $notification->getAttribute('image-link', (int) $lang),
                'shadow_box_height' => $notification->getAttribute('image-height', (int) $lang),
                'shadow_box_width' => $notification->getAttribute('image-width', (int) $lang),
                ));
            }
        } else {
            // TODO : preview html
        }

        $this->context->smarty->assign(array(
            'prestanotifypro_type' => $notification->type,
            'shadow_box_delay_time' => (int) $notification->delay * 1000,
        ));

        return $this->display(__FILE__, 'views/templates/admin/preview.tpl');
    }

    /** Function to Preview image on Backoffice, per language.
     * $id_object is the image id
     * $lang is the lang we wanna preview.
     */
    public function loadImagePreview($id_object, $lang)
    {
        $no_file = $this->DisplayError($this->l('No image found'));
        // $this->img_path isn't working so dirname(__file__)
        if (!file_exists($this->img_content_path.(int) $lang.'/'.$id_object)) {
            $this->context->smarty->assign(array('no_file' => $no_file));
        } else {
            list($width, $height, $type, $attr) = getimagesize($this->img_content_path.(int) $lang.'/'.$id_object);
            $this->context->smarty->assign(array(
                'prestanotifypro_img_path' => $this->img_path.'content/'.(int) $lang.'/',
                'shadow_box_content' => $id_object,
                'shadow_box_content_link' => '',
                'shadow_box_height' => $width,
                'shadow_box_width' => $height,
            ));
        }

        $this->context->smarty->assign(array(
            'prestanotifypro_type' => 'image',
            'shadow_box_delay_time' => 1000,
        ));

        return $this->display(__FILE__, 'views/templates/admin/preview.tpl');
    }

    /**
     * Clear cache for given object.
     *
     * @param object $obj
     */
    public function cleanerObj($obj)
    {
        TinyCache::clearCache(Tools::strtolower(get_class($obj)));
    }

    /**
     * Get results for datatables according to specified role and params for current shop.
     *
     * @param string $role   The result role according to datatable
     * @param string $type   Additionnal param to specify the role
     * @param array  $filter SQL filter params
     * @param array  $order  SQL order by params
     * @param array  $limit  SQL limit params
     *
     * @return array
     */
    public function getDatatableResults($role, $type, $filter, $order, $limit)
    {
        switch ($role) {
            case 'images':
                return $this->getImages($type, $filter, $order, $limit);
            break;
            default:
                return PrestanotifyNotification::getNotifications($this->id_shop, $filter, $order, $limit);
            break;
        }
    }

    /**
     * Count all notifications for current shop.
     *
     * @param string $role   The result role according to datatable
     * @param string $type   Additionnal param to specify the role
     * @param array  $filter SQL filter params
     *
     * @return array
     */
    public function countAllDatatableResults($role, $type, $filter)
    {
        switch ($role) {
            case 'images':
                return self::$last_img_total_count;
            break;
            default:
                return count(PrestanotifyNotification::getNotifications($this->id_shop, $filter));
            break;
        }
    }

    /**
     * Load all images uploaded.
     *
     * @return array
     */
    public function getImages($id_lang = 0, $filter = array(), $order = array(), $limit = array())
    {
        $images = array();

        $is_dot = array('.', '..');
        if (is_dir($this->img_content_path)) {
            if (version_compare(phpversion(), '5.3', '<')) {
                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($this->img_content_path),
                    RecursiveIteratorIterator::SELF_FIRST
                );
            } else {
                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($this->img_content_path, RecursiveDirectoryIterator::SKIP_DOTS),
                    RecursiveIteratorIterator::CHILD_FIRST
                );
            }

            foreach ($iterator as $file) {
                if (version_compare(phpversion(), '5.2.17', '<=')) {
                    if (in_array($file->getBasename(), $is_dot)) {
                        continue;
                    }
                } elseif (version_compare(phpversion(), '5.3', '<')) {
                    if ($file->isDot()) {
                        continue;
                    }
                }

                if (!is_dir($file->getPathname())) {
                    $folder = basename($file->getPath());

                    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                    if (!function_exists('exif_imagetype')) {
                        $a = getimagesize($file->getPathname());
                        $detectedType = $a[2];
                    } else {
                        $detectedType = exif_imagetype($file->getPathname());
                    }
                    $error = !in_array($detectedType, $allowedTypes);
                    // if (ImageManager::isRealImage($file->getPathname()))
                    if (!$error) {
                        $images[strtolower($folder)][] = $file->getBasename();
                    }
                }
                unset($error);
            }
            unset($iterator, $file);
        }

        if ($id_lang !== 0 && isset($images[(int) $id_lang])) {
            $images_to_keep = $images[(int) $id_lang];
            self::$last_img_total_count = count($images_to_keep);

            //Apply filter if needeed
            if (is_array($filter) && count($filter) > 0) {
                foreach ($filter as $column => $search) {
                    foreach ($images_to_keep as $key => $img) {
                        if (!strstr($img, pSQL($search))) {
                            unset($images_to_keep[$key]);
                        }
                    }
                }
            }

            //Apply limit if needed
            if (is_array($limit) && isset($limit['start']) && isset($limit['length'])) {
                $images_to_keep = array_slice($images_to_keep, (int) $limit['start'], (int) $limit['length']);
            }

            if (is_array($order) && count($order) > 0) {
                $dir = array_shift($order);

                if ($dir == 'ASC') {
                    sort($images_to_keep);
                }

                if ($dir == 'DESC') {
                    rsort($images_to_keep);
                }
            }

            return $images_to_keep;
        } elseif ($id_lang == 0) {
            return $images;
        } else {
            return array();
        }
    }

    /***
     *
     * Utilities Functions
     *
     ***/

    /**
     * Display DateTime according to current language.
     *
     * @param string $value
     *
     * @return string
     */
    public function displayDate($value)
    {
        if (version_compare(_PS_VERSION_, '1.5.5.0', '>=')) {
            return Tools::displayDate($value, null, true);
        } else {
            return Tools::displayDate($value, $this->context->language->id, true);
        }
    }

    /**
     * Utility function in order to handle uploaded image.
     *
     * @param string $id_lang
     * @param string $file
     * @param string $new_name
     *
     * @return string
     */
    public function dispatchImage($id_lang, $file, $new_name)
    {
        if (!isset($new_name) || empty($new_name)) {
            $new_name = $file['name'];
        }

        $img_dir = $this->img_content_path.$id_lang.'/';

        if (!is_dir($img_dir)) {
            mkdir($img_dir, 0777, true);
        }

        $image_name = Tools::replaceAccentedChars($new_name);
        $image_name = preg_replace('/[^a-zA-Z0-9_]+/', '', $image_name);
        $image_name = Tools::substr($image_name, 0, 255);

        $type = strtolower(pathinfo($file['tmp_name'], PATHINFO_EXTENSION));

        if ($type == '') {
            $type = pathinfo($file['name'], PATHINFO_EXTENSION);
        }

        $temp_name = $img_dir.$image_name.'.'.$type;

        if (!ImageManager::isRealImage($file['tmp_name'], $file['type'])) {
            return (int) 1;
        } // The file you tried to upload is not an image.
        else {
            if (file_exists($temp_name)) {
                return 2;
            } //'Upload canceled. An image with the same name already exists.';
            if (!rename($file['tmp_name'], $temp_name)) {
                return 3;
            } //'Couldnt rename the image. Please try again or dont rename if the problem remains.';
            @chmod($temp_name, 0777);
        }

        return 'ok';
    }

    /***
     *
     * PrestaShop HOOKS
     *
     ***/
    public function hookdisplayHeader()
    {
        if (!$this->active) {
            return;
        }

        $this->context->controller->addCSS($this->css_path.'shadowbox/shadowbox.css', 'all');
        $this->context->controller->addJS($this->js_path.'shadowbox/shadowbox.js');
    }

    public function hookHeader($params)
    {
        if (!$this->active) {
            return;
        }

        Tools::addCss($this->css_path.'shadowbox/shadowbox.css');
        Tools::addJs($this->js_path.'shadowbox/shadowbox.js');
    }

    public function hookDisplayFooter($params)
    {
        if (!$this->active) {
            return;
        }

        $set_cache = false;

        // Check cookies
        //$prestanotifypro_cookie = new Cookie('prestanotifypro', '/', 0);

        // Prepare notification to ignore according to cookie
        /*$notifications_to_ignore = array();
        if (isset($prestanotifypro_cookie->id_notifications))
            $notifications_to_ignore = explode('_', $prestanotifypro_cookie->id_notifications);*/

        // Find active and valid notification with available display for current language
        $cache_name = 'front_notification_'.(int) $this->id_shop.'_'.(int) $this->context->language->id;
        $notification = TinyCache::getCache($cache_name, 15, 'minutes');

        // If previous notification loading try is already done for the current session, and no notification available,
        // $notifiction equals '' and we don't need to do anything !
        if ($notification == '*') {
            return;
        }

        // We test if current notification in cache is in the ignore list
        /*if (is_object($notification) && in_array($notification->id, $notifications_to_ignore))
            return;*/

        // We test current notification validity in cache
        if (is_object($notification) && !PrestanotifyNotification::isValidPeriod($notification->date_start, $notification->date_end)) {
            return;
        }

        // If $notification == false, there is no valid notification in cache at this time
        if (!$notification) {
            $notification = PrestanotifyNotification::getActiveAndValidNotification((int) $this->context->language->id, (int) $this->id_shop);
            $set_cache = true;
        }

        // If there is no valid notification, we indicate it in cache in order to
        // avoid SQL query for next request
        if (!$notification) {
            TinyCache::setCache($cache_name, '*');

            return;
        }

        // Set Notification in cache
        if ($set_cache) {
            TinyCache::setCache($cache_name, $notification);
        }

        // Check if notification has been already displayed
        /*if (in_array($notification->id, $notifications_to_ignore))
            return;*/

        // Add notification to ignore list and update cookie
        /*$notifications_to_ignore[] = $notification->id;
        $prestanotifypro_cookie->id_notifications = implode('_', $notifications_to_ignore);
        $prestanotifypro_cookie->write();*/

        // Display notification
        if ($notification->type == 'image') {
            // User might have created the notification and removed it afterwards.
            // Since we dont delete the attributes, we verify if it still exist in that current lang.
            $test_attribute = $notification->getAttribute('image', (int) $this->context->language->id);
            if (isset($test_attribute) && !empty($test_attribute)) {
                $this->context->smarty->assign(array(
                'ps_version' => Tools::substr(_PS_VERSION_, 0, 3),
                'popup_id' => $notification->id,
                'prestanotifypro_img_path' => $this->img_path.'content/'.(int) $this->context->language->id.'/',
                'shadow_box_content' => $notification->getAttribute('image', (int) $this->context->language->id),
                'shadow_box_content_link' => $notification->getAttribute('image-link', (int) $this->context->language->id),
                'shadow_box_height' => $notification->getAttribute('image-height', (int) $this->context->language->id),
                'shadow_box_width' => $notification->getAttribute('image-width', (int) $this->context->language->id),
                ));
            }
        } else {
        }

        $this->context->smarty->assign(array(
            'prestanotifypro_type' => $notification->type,
            'shadow_box_delay_time' => (int) $notification->delay,
        ));

        return $this->display(__FILE__, 'views/templates/hook/display-footer.tpl');
    }
}
