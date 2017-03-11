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

class BlockblogpostsItems extends ObjectModel
{


    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'blog_post',
        'primary' => 'id',

    );




    public function deleteSelection($selection)
    {
        foreach ($selection as $value) {
            $obj = new BlockblogpostsItems($value);
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
            $blog_obj->deletePost(array('id'=>(int)$this->id));


            $return = true;
        }
        return $return;
    }


    
}
?>
