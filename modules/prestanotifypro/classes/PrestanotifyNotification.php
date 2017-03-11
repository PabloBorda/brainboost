<?php

/**
 * Define Slider class.
 *
 * A slider is designed for a specific language, and conatins slides
 */
class PrestanotifyNotification extends ObjectModel
{
    // Notification Name (for BO use)
    public $name;

    // Shop concerned abotu the notification
    public $id_shop;

    // Active status of notification (for front display)
    public $active;

    // Type of the notification
    public $type;

    // Delay of the notification
    public $delay;

    // Period of activation
    public $date_start;
    public $date_end;

    // Attributes
    public $attributes;

    protected $table = 'module_prestanotifypro';
    protected static $_table = 'module_prestanotifypro';
    protected $identifier = 'id_notification';

    public function getFields()
    {
        parent::validateFields();

        $fields = array();
        $fields['active'] = (int) $this->active;
        $fields['name'] = pSql($this->name);
        $fields['type'] = pSql($this->type);
        $fields['delay'] = (int) $this->delay;
        if ($this->validateDate($this->date_start)) {
            $fields['date_start'] = pSql($this->date_start);
        } else {
            $fields['date_start'] = '0000-00-00 00:00:00';
        }
        if ($this->validateDate($this->date_end)) {
            $fields['date_end'] = pSql($this->date_end);
        } else {
            $fields['date_end'] = '0000-00-00 00:00:00';
        }
        $fields['id_shop'] = pSql($this->id_shop);

        return $fields;
    }

    public function save($nullValues = false, $autodate = true)
    {
        if (parent::save($nullValues = false, $autodate = true)) {
            if (is_array($this->attributes)) {
                foreach ($this->attributes as $id_lang => $attrs) {
                    foreach ($attrs as $attr) {
                        $id_attribute = (int) Db::getInstance()->getValue('
							SELECT id_attribute
							FROM `'._DB_PREFIX_.bqSQL(self::$_table).'_attribute`
							WHERE id_notification = "'.(int) $this->id.'"
							AND id_lang = "'.(int) $id_lang.'"
							AND name = "'.pSQL($attr['name']).'"
						');

                        if ($id_attribute > 0) {
                            Db::getInstance()->Execute('
								UPDATE `'._DB_PREFIX_.bqSQL(self::$_table).'_attribute`
								SET value = "'.pSQL($attr['value']).'"
								WHERE id_attribute = "'.(int) $id_attribute.'"
							');
                        } else {
                            Db::getInstance()->Execute('
								INSERT INTO `'._DB_PREFIX_.bqSQL(self::$_table).'_attribute`
								(id_notification, id_lang, name, value)
								VALUES ("'.(int) $this->id.'", "'.(int) $id_lang.'", "'.pSQL($attr['name']).'", "'.pSQL($attr['value']).'")
							');
                        }
                    }
                }
            }

            return true;
        }
    }

    // Activate the notification for front display
    public function activate()
    {
        $this->active = true;

        return $this->save();
    }

    // Deactivate the notfication
    public function deactivate()
    {
        $this->active = false;

        return $this->save();
    }

    /*
     * Return the active and valid (date_start date_end) notification associated to the given shop
     */
    public static function getActiveAndValidNotification($id_lang, $id_shop)
    {
        $notifications = Db::getInstance()->executeS('
			SELECT id_notification, date_start, date_end
			FROM '._DB_PREFIX_.bqSQL(self::$_table).'
			WHERE active = "1"
			AND id_shop = "'.(int) $id_shop.'"
			ORDER BY id_notification DESC	
		');
        foreach ($notifications as $notif) {
            if (!self::isValidPeriod($notif['date_start'], $notif['date_end'])) {
                continue;
            }

            $obj = new self($notif['id_notification']);

            if (!Validate::isLoadedObject($obj)) {
                continue;
            }

            $attributes = $obj->getAttributes();

            if (count($attributes) == 0) {
                continue;
            }

            foreach ($attributes as $lang => $attr) {
                if ($id_lang == $lang) {
                    return $obj;
                }
            }
        }

        return false;
    }

    public static function isValidPeriod($date_start, $date_end)
    {
        $now = strtotime(date('Y-m-d H:i:s'));

        if (strtotime($date_start) > $now && $date_start != '0000-00-00 00:00:00') {
            return false;
        }

        if (strtotime($date_end) < $now && $date_end != '0000-00-00 00:00:00') {
            return false;
        }

        return true;
    }
    /*
     * Return all notifications associated to the given language and shop
     */
    public static function getNotifications($id_shop = 1, $filter = array(), $order = array(), $limit = array())
    {
        $sql = '
			SELECT id_notification, name, id_shop, date_start, date_end, type, active, delay
			FROM '._DB_PREFIX_.bqSQL(self::$_table).'
			WHERE id_shop = '.(int) $id_shop;

        if (is_array($filter) && count($filter) > 0) {
            $sql .= ' AND (';

            foreach ($filter as $column => $search) {
                $sql .= bqSQL($column).' LIKE "%'.pSQL($search).'%" OR ';
            }

            $sql = substr_replace($sql, '', -3);
            $sql .= ')';
        }

        if (is_array($order) && count($order) > 0) {
            $sql_order = '';
            foreach ($order as $column => $dir) {
                if ($dir === 'ASC' || $dir === 'DESC') {
                    $sql_order .= $column.' '.$dir.', ';
                }
            }

            $sql_order = substr_replace($sql_order, '', -2);
            if (trim($sql_order) !== '') {
                $sql .= ' ORDER BY ';
                $sql .= $sql_order;
                unset($sql_order);
            }
        }

        if (is_array($limit) && isset($limit['start']) && isset($limit['length'])) {
            $sql .= ' LIMIT '.(int) $limit['start'].', '.(int) $limit['length'];
        }

        $res = Db::getInstance()->ExecuteS($sql);

        return $res == false ? array() : $res;
    }

    /*
     * Add an attribute
     */
    public function addAttribute($name, $id_lang, $value)
    {
        // if (empty($value)) // Blocks user from removing image/link on a predefined language.
        // 	return false;

        if (!is_array($this->attributes) || count($this->attributes) == 0) {
            $this->getAttributes($this->id);
        }

        if (!isset($this->attributes[$id_lang])) {
            $this->attributes[$id_lang] = array();
        }

        $this->attributes[$id_lang][] = array(
            'name' => $name,
            'value' => $value,
        );

        return true;
    }

    /*
     * Return needed attribute associated to the given notification
     */
    public function getAttribute($name, $id_lang)
    {
        if (!$this->id) {
            return '';
        }

        if (!is_array($this->attributes) || count($this->attributes) == 0) {
            $this->getAttributes($this->id);
        }

        if (!isset($this->attributes[$id_lang])) {
            return '';
        }

        foreach ($this->attributes[$id_lang] as $attr) {
            if ($attr['name'] == $name) {
                return $attr['value'];
            }
        }

        return '';
    }

    /*
     * Return all attributes associated to the given notification
     */
    public function getAttributes()
    {
        $this->attributes = array();

        $res = Db::getInstance()->ExecuteS('
            SELECT name, value, id_lang
			FROM `'._DB_PREFIX_.bqSQL(self::$_table).'_attribute`
            WHERE `id_notification` = "'.(int) $this->id.'"
        ');

        foreach ($res as $attr) {
            $this->attributes[$attr['id_lang']][] = array(
                'name' => $attr['name'],
                'value' => $attr['value'],
            );
        }

        return $this->attributes;
    }

    public static function isAnyNotificationUseImage($img_name, $id_lang)
    {
        return Db::getInstance()->getValue('SELECT p.name
			FROM '._DB_PREFIX_.'module_prestanotifypro p
			LEFT JOIN '._DB_PREFIX_.'module_prestanotifypro_attribute pa ON (p.id_notification = pa.id_notification)
			WHERE pa.id_lang = '.(int) $id_lang.' AND pa.value = "'.pSQL($img_name).'" AND p.active = 1');
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        if (version_compare((float) PHP_VERSION, '5.3.0') >= 0) {
            $d = DateTime::createFromFormat($format, $date);
        } else {
            $d = MyDateTime::createFromFormat($format, $date);
        }

        return $d && $d->format($format) == $date;
    }
}

class MyDateTime extends DateTime
{
    public static function createFromFormat($format, $time, $timezone = null)
    {
        if (!$timezone) {
            $timezone = new DateTimeZone(date_default_timezone_get());
        }
        $version = explode('.', phpversion());
        if (((int) $version[0] >= 5 && (int) $version[1] >= 2 && (int) $version[2] > 17)) {
            return parent::createFromFormat($format, $time, $timezone);
        }

        return new DateTime(date($format, strtotime($time)), $timezone);
    }
}
