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

ob_start();

class AdminBlockblogold extends AdminTab{

	public function __construct()

	{
		$this->module = 'blockblog';
		
		if(version_compare(_PS_VERSION_, '1.5', '>')){
			$this->multishop_context = Shop::CONTEXT_ALL;
		}
		
		
		parent::__construct();
		
	}
	
	public function addJS(){
		
	}
	
	public function display()
	{
		
		
	}
	
}