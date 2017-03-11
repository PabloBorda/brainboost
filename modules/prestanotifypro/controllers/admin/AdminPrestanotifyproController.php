<?php
/**
* 2007-2014 PrestaShop.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
* @author    PrestaShop SA <contact@prestashop.com>
* @copyright 2007-2014 PrestaShop SA
* @license   http://addons.prestashop.com/en/content/12-terms-and-conditions-of-use
* International Registered Trademark & Property of PrestaShop SA
*/
class AdminPrestanotifyproController extends ModuleAdminController
{
    public function ajaxProcessReloadData()
    {
        $filter = $order = $limit = array();
        $role = trim(pSQL(Tools::getValue('role')));
        $type = trim(pSQL(Tools::getValue('type')));
        $echo = (int) Tools::getValue('sEcho');
        $search = trim(pSQL(Tools::getValue('sSearch', '')));
        $sorting_cols = (int) Tools::getValue('iSortingCols', 0);
        $display_start = (int) Tools::getValue('iDisplayStart');
        $display_length = (int) Tools::getValue('iDisplayLength');

        switch ($role) {
            case 'images':
                $columns = array('name');
            break;
            default:
                // care multishop
                $columns = array('name', 'id_shop', 'date_start', 'date_end', 'type', 'active', 'delay');
            break;
        }

        $count_columns = count($columns);

        /* search column filtering */
        if ($search !== '') {
            for ($i = 0; $i < $count_columns; ++$i) {
                if (Tools::getValue('bSearchable_'.$i, false) === 'true') {
                    $filter[$columns[$i]] = pSQL($search);
                }
            }
        }

        /* Order column filtering */
        if ($sorting_cols) {
            for ($i = 0; $i < $sorting_cols; ++$i) {
                $sort_dir_x = trim(pSQL(Tools::getValue('sSortDir_'.$i)));
                $sort_col_x = (int) Tools::getValue('iSortCol_'.$i, -1);

                if ($sort_col_x !== -1 && isset($columns[$sort_col_x])) {
                    $order[$columns[$sort_col_x]] = ($sort_dir_x === 'asc' ? 'ASC' : 'DESC');
                }
            }
        }

        /* Set limit */
        if (isset($display_start) && $display_length !== -1) {
            $limit['start'] = $display_start;
            $limit['length'] = $display_length;
        }

        $data = array();
        if (version_compare(_PS_VERSION_, '1.5', '>=') && Shop::isFeatureActive()) {
            $columns = array('name', 'id_shop', 'date_start', 'date_end', 'type', 'active', 'delay');
        } else {
            $columns = array('name', 'date_start', 'date_end', 'type', 'active', 'delay');
        }
        $results = $this->module->getDatatableResults($role, $type, $filter, $order, $limit);
        $total_record = $this->module->countAllDatatableResults($role, $type, $filter);
        $filtered_total = count($results);

        foreach ($results as &$result) {
            $row = array();
            if (is_array($result)) {
                foreach ($result as $key => $value) {
                    if (in_array($key, $columns)) {
                        if ($key === 'active') {
                            $row[] = $this->module->loadStatus($result, $role, $type);
                        } elseif ($key === 'date_start' || $key === 'date_end') {
                            $row[] = (!empty($value) && $value != '0000-00-00 00:00:00') ? Tools::substr($this->module->displayDate($value), 0, -3) : '-';
                        } else {
                            $row[] = $value;
                        }
                    }
                }
                unset($key, $value);
            } else {
                $row[] = $result;
            }
            $row[] = $this->module->loadPreview($result, $role, $type);
            $row[] = $this->module->loadActions($result, $role, $type);
            $data[] = $row;
        }
        unset($result, $results);

        $output = array(
            'sEcho' => $echo,
            'iTotalRecords' => $total_record,
            'iTotalDisplayRecords' => $filtered_total,
            'aaData' => $data,
        );
        exit(Tools::jsonEncode($output));
    }

    /**
     * Switch rule status.
     *
     * @param int $id_rule
     *
     * @return int
     */
    public function ajaxProcessSwitchAction()
    {
        $id_obj = (int) trim(Tools::getValue('id_obj'));
        $notification = new PrestanotifyNotification((int) $id_obj);

        if (!Validate::isLoadedObject($notification)) {
            exit(false);
        }

        if ((int) $notification->active === 1) {
            exit($notification->deactivate());
        } else {
            exit($notification->activate());
        }
    }

    /**
     * Delete all rows from one rule.
     *
     * @param int $id
     *
     * @return html
     */
    public function ajaxProcessDeleteNotif()
    {
        $id_obj = (int) trim(pSQL(Tools::getValue('id')));

        $notification = new PrestanotifyNotification((int) $id_obj);

        if (Validate::isLoadedObject($notification)) {
            if ($notification->active) {
                exit($this->module->displayError("You can't delete an active notification"));
            }

            if (!$notification->delete()) {
                exit($this->module->displayError('An error occured when deleting the notification.'));
            }
        }

        exit($this->module->displayConfirmation('Your notification has been deleted successfully.'));
    }

    /**
     * Delete image from Backoffice Image Manager tab.
     *
     * @param string $name    (image)
     * @param int    $id_lang
     *
     * @return bool
     */
    public function ajaxProcessDeleteImage()
    {
        $img_name = trim(Tools::getValue('id'));
        $id_lang = (int) Tools::getValue('type');

        // Security
        $img_name = str_replace('..', '', $img_name);
        $img_name = str_replace('/', '', $img_name);
        $img_path = _PS_MODULE_DIR_.$this->module->name.'/img/content/'.$id_lang.'/'.$img_name;

        if (ImageManager::isRealImage($img_path)) { // is it a real image ?

            // Check if image is being used in active notification
            $used = PrestanotifyNotification::isAnyNotificationUseImage($img_name, $id_lang);

            if ($used) {
                exit($this->module->displayError("You can't delete an image used for an active notification."));
            }

            if (unlink($img_path)) {
                exit($this->module->displayConfirmation('The image was correctly deleted.'));
            }
        }

        exit($this->module->displayError('The image cannot be deleted. Please make sure the rights are correct on the directory img/content/ of the module.'));
    }

    // Notification Preview in BackOffice
    public function ajaxProcessNotifPreview()
    {
        $lang = (int) Tools::getValue('lang', 0);
        $type = trim(pSQL(Tools::getValue('type', '')));
        $id_obj = (int) Tools::getValue('id_obj', 0); // id_notification

        exit($this->module->loadNotifPreview($id_obj, $lang, $type));
    }

    // Image Preview in BackOffice
    public function ajaxProcessImagePreview()
    {
        $lang = (int) Tools::getValue('type', 0);
        $id_obj = trim(pSQL(Tools::getValue('id_obj', 0))); // id_notification

        exit($this->module->loadImagePreview($id_obj, $lang));
    }

    /**
     * Load the HTML form in the modalbox.
     *
     * @param int    $id_obj
     * @param string $role
     * @param string $type
     *
     * @return html
     */
    public function ajaxProcessLoadForm()
    {
        $id_obj = (int) trim(pSQL(Tools::getValue('id_obj')));
        $role = trim(pSQL(Tools::getValue('role')));
        $type = trim(pSQL(Tools::getValue('type')));
        exit($this->module->loadForm($id_obj, $role, $type));
    }

    /**
     * Save notification.
     *
     * @param array  $params
     * @param string $role
     * @param string $type
     * @param int    $apply
     * @param int    $id_obj
     *
     * @return html
     */
    public function ajaxProcessSaveForm()
    {
        $params = Tools::getValue('params');
        $role = trim(pSQL(Tools::getValue('role')));
        $type = trim(pSQL(Tools::getValue('type')));
        $id_obj = (int) trim(pSQL(Tools::getValue('id_obj')));
        $obj = null;
        $error = false;
        $languages = Language::getLanguages();

        if ($role == 'upload') {
            foreach ($_FILES as $no_file => $file) {
                $id_lang = (int) Tools::substr($no_file, 13);
                $error = $this->module->dispatchImage($id_lang, $file, Tools::getValue('upload-image-name-'.$id_lang));
            }

            if (Validate::isInt($error)) { // errors handled in $this->module->dispatchImage()
                switch ($error) {
                    case 1:
                        exit($this->module->displayError('The file you tried to upload is not an image.'));
                        break;
                    case 2:
                        exit($this->module->displayError('Upload canceled. An image with the same name already exists.'));
                        break;
                    case 3:
                        exit($this->module->displayError('Couldnt rename the image. Please try again or dont rename if the problem remains.'));
                        break;
                    case 4:
                        exit($this->module->displayError('The file you tried to upload is not an image.'));
                        break;
                }
            }
            exit($this->module->displayConfirmation('Your images have been uploaded successfully'));
        }

        if ($role == 'notif') {
            $type = 'image';

            if ($id_obj > 0) {
                $obj = new PrestanotifyNotification($id_obj);
            }

            if ($id_obj == 0 || !Validate::isLoadedObject($obj)) {
                $obj = new PrestanotifyNotification();
            }

            if (!empty($params)) {
                $checked_params = array();

                foreach ($params as &$param) {
                    $name = trim($param['name']);
                    $value = trim($param['value']);

                    if ($name == 'notif_name') {
                        if (!empty($value)) {
                            $obj->name = Tools::substr($value, 0, 50);
                        } else {
                            exit($this->module->displayError('The notification name is empty'));
                        }
                    }

                    if ($name == 'notif_delay') {
                        $obj->delay = (int) $value;
                    }

                    if ($name == 'notif_date_start') {
                        $obj->date_start = $value;
                    }

                    if ($name == 'notif_date_end') {
                        $obj->date_end = $value;
                    }

                    if ($name == 'type' && $value == 'html') {
                        $type = 'html';
                    }

                    if (strpos($name, 'notif-image') !== false) {
                        foreach ($languages as $lang) {
                            if ($name == 'notif-image-'.$lang['id_lang']) {
                                $checked_params[$lang['id_lang']]['image'] = $value;
                            }
                        }
                    }

                    if (strpos($name, 'notif-image-link') !== false) {
                        foreach ($languages as $lang) {
                            if ($name == 'notif-image-link-'.$lang['id_lang']) {
                                $checked_params[$lang['id_lang']]['image-link'] = $value;
                            }
                        }
                    }

                    if (strpos($name, 'notif-image-width') !== false) {
                        foreach ($languages as $lang) {
                            if ($name == 'notif-image-width-'.$lang['id_lang']) {
                                $checked_params[$lang['id_lang']]['image-width'] = $value;
                            }
                        }
                    }

                    if (strpos($name, 'notif-image-height') !== false) {
                        foreach ($languages as $lang) {
                            if ($name == 'notif-image-height-'.$lang['id_lang']) {
                                $checked_params[$lang['id_lang']]['image-height'] = $value;
                            }
                        }
                    }
                }
                unset($params, $param);

                //params validation
                if ($type == 'image') {

                    //we need at least an image name, width and height
                    foreach ($checked_params as $id_lang => $params) {
                        $check_image = false;
                        $check_width = false;
                        $check_height = false;
                        $check_link = false;

                        foreach ($params as $name => $value) {
                            if ($name == 'image' && ($value == '' || !empty($value))) {
                                $check_image = true;
                            }

                            if ($name == 'image-link' && $value == '') {
                                $check_link = true;
                            }
                            if ($name == 'image-link' && $value != '' && !empty($value)) {
                                $check_link = true;
                                if (!(Validate::isAbsoluteUrl($value))) {
                                    $check_link = false;
                                    exit($this->module->displayError('The notification link is incorrect. Example: http://www.prestashop.com'));
                                }
                            }

                            if ($name == 'image-width' && !empty($value) && $value != '') {
                                $check_width = true;
                            }
                            if ($name == 'image-height' && !empty($value) && $value != '') {
                                $check_height = true;
                            }
                        }
                        reset($params);
                        if ($check_image && $check_width && $check_height && $check_link) {
                            foreach ($params as $name => $value) {
                                $obj->addAttribute($name, $id_lang, $value);
                            }
                        }
                    }
                }
            }

            $obj->type = $type;
            if ($id_obj == 0) {
                $obj->active = false;
            }
            $obj->id_shop = $this->module->id_shop;

            if ($error === false && $obj->save()) {
                exit($this->module->displayConfirmation('Your notification has been saved successfully'));
            } else {
                exit($this->module->displayError('An error occurred while creating the notification.'));
            }
        }

        exit($this->module->displayError('An error occurred.'));
    }
}
