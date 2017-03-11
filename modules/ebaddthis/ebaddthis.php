<?php
    
if (!defined('_PS_VERSION_'))
	exit;

class ebaddthis extends Module{
    
    private $_output = '';
    
    function __construct(){
        $this->name = 'ebaddthis';
        $this->tab = 'elation_base_modules';
        $this->version = '1.0';
        $this->author = 'elation3ase';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Elation Base Theme - AddThis Module');
        $this->description = $this->l('AddThis social sharing in product pages.');
    }
    

/*-------------------------------------------------------------*/
/*  INSTALL THE MODULE
/*-------------------------------------------------------------*/
    
    public function install(){
        if (parent::install() && $this->registerHook('displayHeader')){
            $response = Configuration::updateValue('EB_ADDTHIS_PUBID', '');
            return $response;
        }
        return false;
    }
    
    
/*-------------------------------------------------------------*/
/*  UNINSTALL THE MODULE
/*-------------------------------------------------------------*/    
    
    public function uninstall(){
        if (parent::uninstall()){
            $response = Configuration::deleteByName('EB_ADDTHIS_PUBID');
            return $response;
        }
        return false;
    }    
    
    
    
/*-------------------------------------------------------------*/
/*  MODUL INITIALIZE & FORM SUBMIT CHECKs
/*-------------------------------------------------------------*/    
    
        
    public function getContent()
	{
		$this->_output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitEbAddthis'))
		{
                    
                    if (Tools::isSubmit('pubid') && Tools::getValue('pubid') != "" ){
                        Configuration::updateValue('EB_ADDTHIS_PUBID', Tools::getValue('pubid'));
                    }else{
                        $errors[] = $this->l('An error occured. Please check your ProfileID and try again. Or add "0" if you do not want statistics');
                    }                 
                                                
                    if (isset($errors) && sizeof($errors)){
                        $this->_output .= $this->displayError(implode('<br />', $errors));
                    }else{
                        $this->_output .= $this->displayConfirmation($this->l('Configuration Saved!'));
                    }
                        
		}
		return $this->_output.$this->displayForm();
	}


/*-------------------------------------------------------------*/
/*  DISPLAY CONFIGURATION FORM
/*-------------------------------------------------------------*/    
                
	public function displayForm()
	{            
                $this->_output = '
		<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
			<fieldset><legend><img src="'.$this->_path.'/logo.gif" alt="" title="" />'.$this->l('AddThis').'</legend>
				
                                <div class="margin-form">
                                    <p class="clear">'.$this->l('You can get your ProfileID from addthis.com').'</p>
                                </div>


                                <label>'.$this->l('ProfileID').'</label>
				<div class="margin-form">
					<input type="text" name="pubid" value="'.Tools::safeOutput(Configuration::get('EB_ADDTHIS_PUBID')).'" />
					<p class="clear">'.$this->l('Profile ID - Format: xx-xxxxxxxxxxxxxxxx').'</p>
					<p class="clear">'.$this->l('If you do not want statistics on shares you can simple add "0"').'</p>
				</div>
                                
				<center><input type="submit" name="submitEbAddthis" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
		return $this->_output;
	}
        
        
/*-------------------------------------------------------------*/
/*  PREPARE FOR HOOK
/*-------------------------------------------------------------*/          

        private function _prepHook($params){
                       
            $pubid = Configuration::get('EB_ADDTHIS_PUBID');
            
            $this->smarty->assign('pubid', $pubid);
            $addThisRender = $this->display(__FILE__, 'ebaddthis.tpl');
            
            $this->smarty->assignGlobal('addThisRender', $addThisRender);
            
        }
        
        
/*-------------------------------------------------------------*/
/*  HOOK (displayHeader)
/*-------------------------------------------------------------*/
        
        public function hookDisplayHeader ($params){
            $this->_prepHook($params);            
        }
        
}