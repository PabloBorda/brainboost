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

class BlockblogcommentsItems extends ObjectModel
{

    /** @var string Name */
    public $id;
    public $title;
    public $count_posts;
    public $shop_name;
    public $language;
    public $time_add;
    public $status;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'blog_comments',
        'primary' => 'id',
        'fields' => array(
            'id' => array('type' => self::TYPE_INT,'validate' => 'isUnsignedInt','required' => true,),

            'title' => array('type' => self::TYPE_STRING, 'required' => true, 'validate' => 'isGenericName', 'size' => 128),
            'count_posts' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),

            'shop_name' => array('type' => self::TYPE_STRING, 'required' => true, 'validate' => 'isGenericName', 'size' => 128),
            'language' => array('type' => self::TYPE_STRING, 'required' => true, 'validate' => 'isGenericName', 'size' => 128),
            'time_add' => array('type' => self::TYPE_STRING, 'required' => true, 'validate' => 'isGenericName', 'size' => 128),
            'status' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),

        ),

    );




    public function deleteSelection($selection)
    {
        foreach ($selection as $value) {
            $obj = new BlockblogcommentsItems($value);
            if (!$obj->delete()) {
                return false;
            }
        }
        return true;
    }

    public function delete()
    {
        $return = false;

        if (!$this->hasMultishopEntries() || Shop::getContext() == Shop::CONTEXT_ALL) {

            require_once(_PS_MODULE_DIR_ . 'blockblog/classes/blog.class.php');
            $blog_obj = new blog();
            $blog_obj->deleteComment(array('id'=>(int)$this->id));


            $return = true;
        }
        return $return;
    }


    
}
?>
