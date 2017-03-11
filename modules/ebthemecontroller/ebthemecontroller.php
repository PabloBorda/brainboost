<?php
    
if (!defined('_PS_VERSION_'))
	exit;

class ebthemecontroller extends Module{
    
    private $_output = '';
    
    function __construct(){
        $this->name = 'ebthemecontroller';
        $this->tab = 'elation_base_modules';
        $this->version = '1.0';
        $this->author = 'Elation Base';
        $this->need_instance = 0;

        parent::__construct();
		$this->bootstrap = true;

        $this->displayName = $this->l('Elation Base Advance Theme Controller');
        $this->description = $this->l('Configuration for your theme.');
    }
    

/*-------------------------------------------------------------*/
/*  INSTALL THE MODULE
/*-------------------------------------------------------------*/
    
    public function install(){
        if (parent::install() && $this->registerHook('displayHeader')){
			/* Install Variables */
            $response = Configuration::updateValue('EB_THEME_VERSION', 'light');
            $response = Configuration::updateValue('EB_THEME_HOVERCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_HOVER', 'bubblegrow');
            $response = Configuration::updateValue('EB_THEME_LAYOUT', '');
            $response = Configuration::updateValue('EB_THEME_BGCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_HEADBGCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_HEADTXTCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_HEADHICOLOR', '');
            $response = Configuration::updateValue('EB_THEME_HICOLOR', '');
            $response = Configuration::updateValue('EB_THEME_TXTCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_LINKCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_HEADCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_BTNCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_BTNTXT', '');
            $response = Configuration::updateValue('EB_THEME_BTNCOLOROVER', '');
            $response = Configuration::updateValue('EB_THEME_BTNTXTOVER', '');
            $response = Configuration::updateValue('EB_THEME_TOPFOOTERBG', '');
            $response = Configuration::updateValue('EB_THEME_TOPFOOTERLINK', '');
            $response = Configuration::updateValue('EB_THEME_TOPFOOTERTXT', '');
            $response = Configuration::updateValue('EB_THEME_NAVBGCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_NAVBGHICOLOR', '');
            $response = Configuration::updateValue('EB_THEME_NAVTXTCOLOR', '');
            $response = Configuration::updateValue('EB_THEME_NAVHICOLOR', '');
            $response = Configuration::updateValue('EB_THEME_NAVDISPLAY', 'mega');
            $response = Configuration::updateValue('EB_THEME_RADIUS', '');
            $response = Configuration::updateValue('EB_THEME_FONTSBODY', 'Exo 2');
            $response = Configuration::updateValue('EB_THEME_FONTSHEAD', 'Exo 2');
            $response = Configuration::updateValue('EB_THEME_QUICKBUY', '1');
			
			
            return $response;
        }
        return false;
    }
    
    
/*-------------------------------------------------------------*/
/*  UNINSTALL THE MODULE
/*-------------------------------------------------------------*/    
    
    public function uninstall(){
        if (parent::uninstall()){
			/* Uninstall Variables */
            $response = Configuration::deleteByName('EB_THEME_VERSION');
            $response = Configuration::deleteByName('EB_THEME_HOVERCOLOR');
            $response = Configuration::deleteByName('EB_THEME_HOVER');
            $response = Configuration::deleteByName('EB_THEME_LAYOUT');
            $response = Configuration::deleteByName('EB_THEME_BGCOLOR');
            $response = Configuration::deleteByName('EB_THEME_HICOLOR');
            $response = Configuration::deleteByName('EB_THEME_HEADBGCOLOR');
            $response = Configuration::deleteByName('EB_THEME_HEADTXTCOLOR');
            $response = Configuration::deleteByName('EB_THEME_HEADHICOLOR');
            $response = Configuration::deleteByName('EB_THEME_TXTCOLOR');
            $response = Configuration::deleteByName('EB_THEME_LINKCOLOR');
            $response = Configuration::deleteByName('EB_THEME_HEADCOLOR');
            $response = Configuration::deleteByName('EB_THEME_BTNCOLOR');
            $response = Configuration::deleteByName('EB_THEME_BTNTXT');
            $response = Configuration::deleteByName('EB_THEME_BTNCOLOROVER');
            $response = Configuration::deleteByName('EB_THEME_BTNTXTOVER');
            $response = Configuration::deleteByName('EB_THEME_TOPFOOTERBG');
            $response = Configuration::deleteByName('EB_THEME_TOPFOOTERLINK');
            $response = Configuration::deleteByName('EB_THEME_TOPFOOTERTXT');
            $response = Configuration::deleteByName('EB_THEME_NAVBGCOLOR');
            $response = Configuration::deleteByName('EB_THEME_NAVBGHICOLOR');
            $response = Configuration::deleteByName('EB_THEME_NAVTXTCOLOR');
            $response = Configuration::deleteByName('EB_THEME_NAVHICOLOR');
            $response = Configuration::deleteByName('EB_THEME_NAVDISPLAY');
            $response = Configuration::deleteByName('EB_THEME_RADIUS');
            $response = Configuration::deleteByName('EB_THEME_FONTSBODY');
            $response = Configuration::deleteByName('EB_THEME_FONTSHEAD');
            $response = Configuration::deleteByName('EB_THEME_QUICKBUY');
            return $response;
        }
        return false;
    }    
    
    
    
/*-------------------------------------------------------------*/
/*  MODULE INITIALIZE & FORM SUBMIT
/*-------------------------------------------------------------*/    
    
        
    public function getContent()
	{
		$this->_output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitEbThemeController'))
		{
			/* Save Variables */
			Configuration::updateValue('EB_THEME_VERSION', Tools::getValue('themeversion'));
			Configuration::updateValue('EB_THEME_HOVERCOLOR', Tools::getValue('hovercolor'));
			Configuration::updateValue('EB_THEME_HOVER', Tools::getValue('hover'));
			Configuration::updateValue('EB_THEME_LAYOUT', Tools::getValue('themelayout'));
			Configuration::updateValue('EB_THEME_BGCOLOR', Tools::getValue('bgcolor'));
			Configuration::updateValue('EB_THEME_HICOLOR', Tools::getValue('hicolor')); 
			Configuration::updateValue('EB_THEME_HEADBGCOLOR', Tools::getValue('headbgcolor')); 
			Configuration::updateValue('EB_THEME_HEADTXTCOLOR', Tools::getValue('headtxtcolor')); 
			Configuration::updateValue('EB_THEME_HEADHICOLOR', Tools::getValue('headhicolor')); 
			Configuration::updateValue('EB_THEME_TXTCOLOR', Tools::getValue('txtcolor')); 
			Configuration::updateValue('EB_THEME_LINKCOLOR', Tools::getValue('linkcolor')); 
			Configuration::updateValue('EB_THEME_HEADCOLOR', Tools::getValue('headcolor')); 
			Configuration::updateValue('EB_THEME_BTNCOLOR', Tools::getValue('btncolor'));
			Configuration::updateValue('EB_THEME_BTNTXT', Tools::getValue('btntxt'));
			Configuration::updateValue('EB_THEME_BTNCOLOROVER', Tools::getValue('btncolorover'));
			Configuration::updateValue('EB_THEME_BTNTXTOVER', Tools::getValue('btntxtover'));
			Configuration::updateValue('EB_THEME_TOPFOOTERBG', Tools::getValue('topfooterbg'));
			Configuration::updateValue('EB_THEME_TOPFOOTERLINK', Tools::getValue('topfooterlink'));
			Configuration::updateValue('EB_THEME_TOPFOOTERTXT', Tools::getValue('topfootertxt'));
			Configuration::updateValue('EB_THEME_NAVBGCOLOR', Tools::getValue('navbgcolor'));
			Configuration::updateValue('EB_THEME_NAVBGHICOLOR', Tools::getValue('navbghicolor'));
			Configuration::updateValue('EB_THEME_NAVTXTCOLOR', Tools::getValue('navtxtcolor'));
			Configuration::updateValue('EB_THEME_NAVHICOLOR', Tools::getValue('navhicolor'));
			Configuration::updateValue('EB_THEME_NAVDISPLAY', Tools::getValue('navdisplay'));
			Configuration::updateValue('EB_THEME_RADIUS', Tools::getValue('radius'));
			Configuration::updateValue('EB_THEME_FONTSBODY', Tools::getValue('fontsbody'));
			Configuration::updateValue('EB_THEME_FONTSHEAD', Tools::getValue('fontshead'));
			Configuration::updateValue('EB_THEME_QUICKBUY', Tools::getValue('quickbuy'));
			           
			$this->_output .= $this->displayConfirmation($this->l('Configuration Saved!'));
                        
		}
		return $this->_output.$this->displayForm();
	}


/*-------------------------------------------------------------*/
/*  DISPLAY CONFIGURATION FORM
/*-------------------------------------------------------------*/    
    
	public function displayForm()
	{
		$this->_output = '
		<link rel="stylesheet" href="../modules/'.$this->name.'/_assets/spectrum.css" type="text/css" />
		<script type="text/javascript" src="../modules/'.$this->name.'/_assets/spectrum.js"></script>
		<script type="text/javascript" src="../modules/'.$this->name.'/_assets/functions.js"></script>
		<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
		<div class="panel themecontroller" id="fieldset_0">
			<h3><i class="icon-cogs" style="font-size:inherit"></i> Settings </h3>		
			<fieldset>
				<div>
					<p class="clear">'.$this->l('You can configure your theme here').'</p>
				</div>
				<fieldset class="form-group">
					<legend> 
						<i class="icon-dashboard"></i>
						'.$this->l('Main Theme Options').'
						<a href="#" class="icon-plus icon-right"></a>
					</legend>
					<div class="group-block">
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Theme Version').'
							</label>
							<div class="col-lg-9">
								<div class="col-lg-12">
									'.$this->l('Light Version').'
									<input type="radio" name="themeversion" value="light" '.Tools::safeOutput(Configuration::get('EB_THEME_VERSION') ==  'light' ? ' checked="checked"' : '').'>
								</div>	
								<div class="col-lg-12">
									'.$this->l('Dark Version').'
									<input type="radio" name="themeversion" value="dark" '.Tools::safeOutput(Configuration::get('EB_THEME_VERSION') ==  'dark' ? ' checked="checked"' : '').'>
								</div>	
							</div>	
						</div>
						<div class="form-group">
						<label class="control-label col-lg-3">
								'.$this->l('Background Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="bgcolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_BGCOLOR')).'" class="triggerSet" />
							</div>	
						</div>
						<!--
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Hightlight Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="hicolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_HICOLOR')).'" class="triggerSet" />
							</div>
						</div>
						-->
					</div>
				</fieldset>
				<fieldset class="form-group">
					<legend> 
						<i class="icon-font"></i>
						'.$this->l('Type Options').'
						<a href="#" class="icon-plus icon-right"></a>
					</legend>
					<div class="group-block">
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Text Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="txtcolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_TXTCOLOR')).'" class="triggerSet" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Text link Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="linkcolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_LINKCOLOR')).'" class="triggerSet" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Main Font').'
							</label>
							<div class="col-lg-9">
								<select name="fontsbody">
									<option value="Exo 2" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Exo 2' ? ' selected="selected"' : '').'>Default Theme Font</option>
									<option value="">--------------</option>
									<option value="Nova Oval">COMIC / DISPLAY</option>
									<option value="Nova Oval" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Nova Oval' ? ' selected="selected"' : '').'>-- Nova Oval</option>
									<option value="Chicle" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Chicle' ? ' selected="selected"' : '').'>-- Chicle</option>
									<option value="Cabin Sketch" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Cabin Sketch' ? ' selected="selected"' : '').'>-- Cabin Sketch</option>
									<option value="Caesar Dressing" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Caesar Dressing' ? ' selected="selected"' : '').'>-- Caesar Dressing</option>
									<option value="Cherry Cream Soda" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Cherry Cream Soda' ? ' selected="selected"' : '').'>-- Cherry Cream Soda</option>
									<option value="Sail" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Sail' ? ' selected="selected"' : '').'>-- Sail</option>
									<option value="Jolly Lodger" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Jolly Lodger' ? ' selected="selected"' : '').'>-- Jolly Lodger</option>
									<option value="Finger Paint" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Finger Paint' ? ' selected="selected"' : '').'>-- Finger Paint</option>
									<option value="Monoton" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Monoton' ? ' selected="selected"' : '').'>-- Monoton</option>
									<option value="Freckle Face" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Freckle Face' ? ' selected="selected"' : '').'>-- Freckle Face</option>
									<option value="Ceviche One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Ceviche One' ? ' selected="selected"' : '').'>-- Ceviche One</option>
									<option value="Metamorphous" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Metamorphous' ? ' selected="selected"' : '').'>-- Metamorphous</option>
									<option value="Ribeye Marrow" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Ribeye Marrow' ? ' selected="selected"' : '').'>-- Ribeye Marrow</option>
									<option value="Bangers" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Bangers' ? ' selected="selected"' : '').'>-- Bangers</option>
									<option value="Sansita One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Sansita One' ? ' selected="selected"' : '').'>-- Sansita One</option>
									<option value="Press Start 2P" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Press Start 2P' ? ' selected="selected"' : '').'>-- Press Start 2P</option>
									<option value="Sofadi One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Sofadi One' ? ' selected="selected"' : '').'>-- Sofadi One</option>
									<option value="">--------------</option>
									<option value="Shadows Into Light Two">HAND DRAWN</option>
									<option value="Crafty Girls" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Crafty Girls' ? ' selected="selected"' : '').'>-- Crafty Girls</option>
									<option value="Bad Script" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Bad Script' ? ' selected="selected"' : '').'>-- Bad Script</option>
									<option value="Petit Formal Script" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Petit Formal Script' ? ' selected="selected"' : '').'>-- Petit Formal Script</option>
									<option value="Felipa" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Felipa' ? ' selected="selected"' : '').'>-- Felipa</option>
									<option value="Gochi Hand" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Gochi Hand' ? ' selected="selected"' : '').'>-- Gochi Hand</option>
									<option value="Alex Brush" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Alex Brush' ? ' selected="selected"' : '').'>-- Alex Brush</option>
									<option value="Calligraffitti" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Calligraffitti' ? ' selected="selected"' : '').'>-- Calligraffitti</option>
									<option value="Great Vibes" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Great Vibes' ? ' selected="selected"' : '').'>-- Great Vibes</option>
									<option value="Annie Use Your Telescope" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Annie Use Your Telescope' ? ' selected="selected"' : '').'>-- Annie Use Your Telescope</option>
									<option value="Arizonia" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Arizonia' ? ' selected="selected"' : '').'>-- Arizonia</option>
									<option value="Berkshire Swash" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Berkshire Swash' ? ' selected="selected"' : '').'>-- Berkshire Swash</option>
									<option value="Coming Soon" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Coming Soon' ? ' selected="selected"' : '').'>-- Coming Soon</option>
									<option value="Covered By Your Grace" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Covered By Your Grace' ? ' selected="selected"' : '').'>-- Covered By Your Grace</option>
									<option value="Dancing Script" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Dancing Script' ? ' selected="selected"' : '').'>-- Dancing Script</option>
									<option value="Over the Rainbow" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Over the Rainbow' ? ' selected="selected"' : '').'>-- Over the Rainbow</option>
									<option value="Satisfy" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Satisfy' ? ' selected="selected"' : '').'>-- Satisfy</option>
									<option value="Shadows Into Light Two" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Shadows Into Light Two' ? ' selected="selected"' : '').'>-- Shadows Into Light Two</option>
									<option value="">--------------</option>
									<option value="Roboto Condensed">SANS SERIF</option>
									<option value="Open Sans" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Open Sans' ? ' selected="selected"' : '').'>-- Open Sans</option>
									<option value="Source Sans Pro" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Source Sans Pro' ? ' selected="selected"' : '').'>-- Source Sans Pro</option>
									<option value="Dosis" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Dosis' ? ' selected="selected"' : '').'>-- Dosis</option>
									<option value="Noto Sans" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Noto Sans' ? ' selected="selected"' : '').'>-- Noto Sans</option>
									<option value="BenchNine" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'BenchNine' ? ' selected="selected"' : '').'>-- BenchNine</option>
									<option value="Anaheim" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Anaheim' ? ' selected="selected"' : '').'>-- Anaheim</option>
									<option value="Armata" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Armata' ? ' selected="selected"' : '').'>-- Armata</option>
									<option value="PT Sans Narrow" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'PT Sans Narrow' ? ' selected="selected"' : '').'>-- PT Sans Narrow</option>
									<option value="Wendy One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Wendy One' ? ' selected="selected"' : '').'>-- Wendy One</option>
									<option value="Roboto" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Roboto' ? ' selected="selected"' : '').'>-- Roboto</option>
									<option value="Roboto Condensed" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Roboto Condensed' ? ' selected="selected"' : '').'>-- Roboto Condensed</option>
									<option value="Oswald" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Oswald' ? ' selected="selected"' : '').'>-- Oswald</option>
									<option value="Cuprum" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Cuprum' ? ' selected="selected"' : '').'>-- Cuprum</option>
									<option value="Inconsolata" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Inconsolata' ? ' selected="selected"' : '').'>-- Inconsolata</option>
									<option value="Pontano Sans" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Pontano Sans' ? ' selected="selected"' : '').'>-- Pontano Sans</option>
									<option value="Jura" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Jura' ? ' selected="selected"' : '').'>-- Jura</option>
									<option value="Advent Pro" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Advent Pro' ? ' selected="selected"' : '').'>-- Advent Pro</option>
									<option value="Capriola" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Capriola' ? ' selected="selected"' : '').'>-- Capriola</option>
									<option value="Ruluko" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Ruluko' ? ' selected="selected"' : '').'>-- Ruluko</option>
									<option value="Bubbler One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Bubbler One' ? ' selected="selected"' : '').'>-- Bubbler One</option>
									<option value="">--------------</option>
									<option value="Fauna One">SERIF</option>
									<option value="Lustria" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Lustria' ? ' selected="selected"' : '').'>-- Lustria</option>
									<option value="IM Fell DW Pica SC" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'IM Fell DW Pica SC' ? ' selected="selected"' : '').'>-- IM Fell DW Pica SC</option>
									<option value="Fenix" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Fenix' ? ' selected="selected"' : '').'>-- Fenix</option>
									<option value="Arbutus Slab" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Arbutus Slab' ? ' selected="selected"' : '').'>-- Arbutus Slab</option>
									<option value="Fauna One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Fauna One' ? ' selected="selected"' : '').'>-- Fauna One</option>
									<option value="Neuton" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Neuton' ? ' selected="selected"' : '').'>-- Neuton</option>
									<option value="Gilda Display" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Gilda Display' ? ' selected="selected"' : '').'>-- Gilda Display</option>
									<option value="Mate" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Mate' ? ' selected="selected"' : '').'>-- Mate</option>
									<option value="Rosarivo" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Rosarivo' ? ' selected="selected"' : '').'>-- Rosarivo</option>
									<option value="Coustard" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Coustard' ? ' selected="selected"' : '').'>-- Coustard</option>
									<option value="Belgrano" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Belgrano' ? ' selected="selected"' : '').'>-- Belgrano</option>
									<option value="Podkova" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Podkova' ? ' selected="selected"' : '').'>-- Podkova</option>
									<option value="Oranienbaum" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Oranienbaum' ? ' selected="selected"' : '').'>-- Oranienbaum</option>
									<option value="Kreon" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Kreon' ? ' selected="selected"' : '').'>-- Kreon</option>
									<option value="Rokkitt" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Rokkitt' ? ' selected="selected"' : '').'>-- Rokkitt</option>
									<option value="Josefin Slab" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Josefin Slab' ? ' selected="selected"' : '').'>-- Josefin Slab</option>
									<option value="Inika" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Inika' ? ' selected="selected"' : '').'>-- Inika</option>
									<option value="Marko One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Marko One' ? ' selected="selected"' : '').'>-- Marko One</option>
									<option value="Gabriela" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSBODY') == 'Gabriela' ? ' selected="selected"' : '').'>-- Gabriela</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Headline text Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="headcolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_HEADCOLOR')).'" class="triggerSet" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Headline Font').'
							</label>
							<div class="col-lg-9">
								<select name="fontshead">
									<option value="Exo 2" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Exo 2' ? ' selected="selected"' : '').'>Default Theme Font</option>
									<option value="">--------------</option>
									<option value="Nova Oval">COMIC / DISPLAY</option>
									<option value="Nova Oval" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Nova Oval' ? ' selected="selected"' : '').'>-- Nova Oval</option>
									<option value="Chicle" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Chicle' ? ' selected="selected"' : '').'>-- Chicle</option>
									<option value="Cabin Sketch" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Cabin Sketch' ? ' selected="selected"' : '').'>-- Cabin Sketch</option>
									<option value="Caesar Dressing" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Caesar Dressing' ? ' selected="selected"' : '').'>-- Caesar Dressing</option>
									<option value="Cherry Cream Soda" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Cherry Cream Soda' ? ' selected="selected"' : '').'>-- Cherry Cream Soda</option>
									<option value="Sail" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Sail' ? ' selected="selected"' : '').'>-- Sail</option>
									<option value="Jolly Lodger" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Jolly Lodger' ? ' selected="selected"' : '').'>-- Jolly Lodger</option>
									<option value="Finger Paint" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Finger Paint' ? ' selected="selected"' : '').'>-- Finger Paint</option>
									<option value="Monoton" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD'	) == 'Monoton' ? ' selected="selected"' : '').'>-- Monoton</option>
									<option value="Freckle Face" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Freckle Face' ? ' selected="selected"' : '').'>-- Freckle Face</option>
									<option value="Ceviche One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Ceviche One' ? ' selected="selected"' : '').'>-- Ceviche One</option>
									<option value="Metamorphous" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Metamorphous' ? ' selected="selected"' : '').'>-- Metamorphous</option>
									<option value="Ribeye Marrow" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Ribeye Marrow' ? ' selected="selected"' : '').'>-- Ribeye Marrow</option>
									<option value="Bangers" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Bangers' ? ' selected="selected"' : '').'>-- Bangers</option>
									<option value="Sansita One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Sansita One' ? ' selected="selected"' : '').'>-- Sansita One</option>
									<option value="Press Start 2P" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Press Start 2P' ? ' selected="selected"' : '').'>-- Press Start 2P</option>
									<option value="Sofadi One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Sofadi One' ? ' selected="selected"' : '').'>-- Sofadi One</option>
									<option value="">--------------</option>
									<option value="Shadows Into Light Two">HAND DRAWN</option>
									<option value="Crafty Girls" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Crafty Girls' ? ' selected="selected"' : '').'>-- Crafty Girls</option>
									<option value="Bad Script" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Bad Script' ? ' selected="selected"' : '').'>-- Bad Script</option>
									<option value="Petit Formal Script" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Petit Formal Script' ? ' selected="selected"' : '').'>-- Petit Formal Script</option>
									<option value="Felipa" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Felipa' ? ' selected="selected"' : '').'>-- Felipa</option>
									<option value="Gochi Hand" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Gochi Hand' ? ' selected="selected"' : '').'>-- Gochi Hand</option>
									<option value="Alex Brush" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Alex Brush' ? ' selected="selected"' : '').'>-- Alex Brush</option>
									<option value="Calligraffitti" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Calligraffitti' ? ' selected="selected"' : '').'>-- Calligraffitti</option>
									<option value="Great Vibes" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Great Vibes' ? ' selected="selected"' : '').'>-- Great Vibes</option>
									<option value="Annie Use Your Telescope" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Annie Use Your Telescope' ? ' selected="selected"' : '').'>-- Annie Use Your Telescope</option>
									<option value="Arizonia" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Arizonia' ? ' selected="selected"' : '').'>-- Arizonia</option>
									<option value="Berkshire Swash" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Berkshire Swash' ? ' selected="selected"' : '').'>-- Berkshire Swash</option>
									<option value="Coming Soon" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Coming Soon' ? ' selected="selected"' : '').'>-- Coming Soon</option>
									<option value="Covered By Your Grace" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Covered By Your Grace' ? ' selected="selected"' : '').'>-- Covered By Your Grace</option>
									<option value="Dancing Script" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Dancing Script' ? ' selected="selected"' : '').'>-- Dancing Script</option>
									<option value="Over the Rainbow" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Over the Rainbow' ? ' selected="selected"' : '').'>-- Over the Rainbow</option>
									<option value="Satisfy" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Satisfy' ? ' selected="selected"' : '').'>-- Satisfy</option>
									<option value="Shadows Into Light Two" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Shadows Into Light Two' ? ' selected="selected"' : '').'>-- Shadows Into Light Two</option>
									<option value="">--------------</option>
									<option value="Roboto">SANS SERIF</option>
									<option value="Open Sans" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Open Sans' ? ' selected="selected"' : '').'>-- Open Sans</option>
									<option value="Source Sans Pro" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Source Sans Pro' ? ' selected="selected"' : '').'>-- Source Sans Pro</option>
									<option value="Dosis" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Dosis' ? ' selected="selected"' : '').'>-- Dosis</option>
									<option value="Noto Sans" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Noto Sans' ? ' selected="selected"' : '').'>-- Noto Sans</option>
									<option value="BenchNine" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'BenchNine' ? ' selected="selected"' : '').'>-- BenchNine</option>
									<option value="Anaheim" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Anaheim' ? ' selected="selected"' : '').'>-- Anaheim</option>
									<option value="Armata" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Armata' ? ' selected="selected"' : '').'>-- Armata</option>
									<option value="PT Sans Narrow" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'PT Sans Narrow' ? ' selected="selected"' : '').'>-- PT Sans Narrow</option>
									<option value="Wendy One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Wendy One' ? ' selected="selected"' : '').'>-- Wendy One</option>
									<option value="Roboto" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Roboto' ? ' selected="selected"' : '').'>-- Roboto</option>
									<option value="Roboto Condensed" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Roboto Condensed' ? ' selected="selected"' : '').'>-- Roboto Condensed</option>
									<option value="Oswald" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Oswald' ? ' selected="selected"' : '').'>-- Oswald</option>
									<option value="Cuprum" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Cuprum' ? ' selected="selected"' : '').'>-- Cuprum</option>
									<option value="Inconsolata" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Inconsolata' ? ' selected="selected"' : '').'>-- Inconsolata</option>
									<option value="Pontano Sans" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Pontano Sans' ? ' selected="selected"' : '').'>-- Pontano Sans</option>
									<option value="Jura" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Jura' ? ' selected="selected"' : '').'>-- Jura</option>
									<option value="Advent Pro" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Advent Pro' ? ' selected="selected"' : '').'>-- Advent Pro</option>
									<option value="Capriola" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Capriola' ? ' selected="selected"' : '').'>-- Capriola</option>
									<option value="Ruluko" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Ruluko' ? ' selected="selected"' : '').'>-- Ruluko</option>
									<option value="Bubbler One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Bubbler One' ? ' selected="selected"' : '').'>-- Bubbler One</option>
									<option value="">--------------</option>
									<option value="Fauna One">SERIF</option>
									<option value="Lustria" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Lustria' ? ' selected="selected"' : '').'>-- Lustria</option>
									<option value="IM Fell DW Pica SC" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'IM Fell DW Pica SC' ? ' selected="selected"' : '').'>-- IM Fell DW Pica SC</option>
									<option value="Fenix" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Fenix' ? ' selected="selected"' : '').'>-- Fenix</option>
									<option value="Arbutus Slab" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Arbutus Slab' ? ' selected="selected"' : '').'>-- Arbutus Slab</option>
									<option value="Fauna One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Fauna One' ? ' selected="selected"' : '').'>-- Fauna One</option>
									<option value="Neuton" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Neuton' ? ' selected="selected"' : '').'>-- Neuton</option>
									<option value="Gilda Display" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Gilda Display' ? ' selected="selected"' : '').'>-- Gilda Display</option>
									<option value="Mate" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Mate' ? ' selected="selected"' : '').'>-- Mate</option>
									<option value="Rosarivo" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Rosarivo' ? ' selected="selected"' : '').'>-- Rosarivo</option>
									<option value="Coustard" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Coustard' ? ' selected="selected"' : '').'>-- Coustard</option>
									<option value="Belgrano" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Belgrano' ? ' selected="selected"' : '').'>-- Belgrano</option>
									<option value="Podkova" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Podkova' ? ' selected="selected"' : '').'>-- Podkova</option>
									<option value="Oranienbaum" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Oranienbaum' ? ' selected="selected"' : '').'>-- Oranienbaum</option>
									<option value="Kreon" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Kreon' ? ' selected="selected"' : '').'>-- Kreon</option>
									<option value="Rokkitt" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Rokkitt' ? ' selected="selected"' : '').'>-- Rokkitt</option>
									<option value="Josefin Slab" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Josefin Slab' ? ' selected="selected"' : '').'>-- Josefin Slab</option>
									<option value="Inika" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Inika' ? ' selected="selected"' : '').'>-- Inika</option>
									<option value="Marko One" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Marko One' ? ' selected="selected"' : '').'>-- Marko One</option>
									<option value="Gabriela" '.Tools::safeOutput(Configuration::get('EB_THEME_FONTSHEAD') == 'Gabriela' ? ' selected="selected"' : '').'>-- Gabriela</option>
								</select>
							</div>
						</div>
					</div>
				</fieldset>
				
				<fieldset class="form-group">
					<legend> 
						<i class="icon-caret-square-o-right"></i>
						'.$this->l('Buttons Options').'
						<a href="#" class="icon-plus icon-right"></a>
					</legend>
					<div class="group-block">
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Buttons Background Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="btncolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_BTNCOLOR')).'" class="triggerSet" />
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Buttons Text Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="btntxt" value="'.Tools::safeOutput(Configuration::get('EB_THEME_BTNTXT')).'" class="triggerSet" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Buttons Mouseover Background Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="btncolorover" value="'.Tools::safeOutput(Configuration::get('EB_THEME_BTNCOLOROVER')).'" class="triggerSet" />
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Buttons Mouseover Text Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="btntxtover" value="'.Tools::safeOutput(Configuration::get('EB_THEME_BTNTXTOVER')).'" class="triggerSet" />
							</div>	
						</div>
					</div>
				</fieldset>
				
				<fieldset class="form-group">
					<legend> 
						<i class="icon-picture-o"></i>
						'.$this->l('Product Options').'
						<a href="#" class="icon-plus icon-right"></a>
					</legend>
					<div class="group-block">
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Hover background').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="hovercolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_HOVERCOLOR')).'" class="triggerSet" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Product hover effect').'
							</label>
							<div class="col-lg-9">
								<select name="hover">
									<option value="bubblegrow" '.Tools::safeOutput(Configuration::get('EB_THEME_HOVER') == 'bubblegrow' ? ' selected="selected"' : '').'>bubble grow</option>
									<option value="bubbleout" '.Tools::safeOutput(Configuration::get('EB_THEME_HOVER') == 'bubbleout' ? ' selected="selected"' : '').'>bubble out</option>
									<option value="fade" '.Tools::safeOutput(Configuration::get('EB_THEME_HOVER') == 'fade' ? ' selected="selected"' : '').'>fade</option>
									<option value="slide" '.Tools::safeOutput(Configuration::get('EB_THEME_HOVER') == 'slide' ? ' selected="selected"' : '').'>slide</option>
									<option value="reveal" '.Tools::safeOutput(Configuration::get('EB_THEME_HOVER') == 'reveal' ? ' selected="selected"' : '').'>reveal</option>
									<option value="flip" '.Tools::safeOutput(Configuration::get('EB_THEME_HOVER') == 'flip' ? ' selected="selected"' : '').'>flip</option>
									<option value="grow" '.Tools::safeOutput(Configuration::get('EB_THEME_HOVER') == 'grow' ? ' selected="selected"' : '').'>grow</option>
								</select>
							</div>
						</div>
						
						<!--
						<label class="control-label col-lg-3">
							'.$this->l('Product Listing Initial Layout').'
						</label>
						<div class="col-lg-9">
							'.$this->l('Product Grid').'
							<input type="radio" name="themelayout" value="grid" '.Tools::safeOutput(Configuration::get('EB_THEME_LAYOUT') ==  'grid' ? ' checked="checked"' : '').'>
							'.$this->l('Product List').'
							<input type="radio" name="themelayout" value="list" '.Tools::safeOutput(Configuration::get('EB_THEME_LAYOUT') ==  'list' ? ' checked="checked"' : '').'>
						</div>	
						-->
					</div>
				</fieldset>
				
				<fieldset class="form-group">
					<legend> 
						<i class="icon-chevron-up"></i>
						'.$this->l('Header Options').'
						<a href="#" class="icon-plus icon-right"></a>
					</legend>
					<div class="group-block">
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Header Background Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="headbgcolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_HEADBGCOLOR')).'" class="triggerSet" />
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Header Text Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="headtxtcolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_HEADTXTCOLOR')).'" class="triggerSet" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Header Text Hover Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="headhicolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_HEADHICOLOR')).'" class="triggerSet" />
							</div>
						</div>
					</div>
				</fieldset>
				
				<fieldset class="form-group">
					<legend> 
						<i class="icon-bars"></i>
						'.$this->l('Top Navigation Options').'
						<a href="#" class="icon-plus icon-right"></a>
					</legend>
					<div class="group-block">
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Top Navigation Background Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="navbgcolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_NAVBGCOLOR')).'" class="triggerSet" />
							</div>	
						</div>
						
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Top Navigation Hover Background Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="navbghicolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_NAVBGHICOLOR')).'" class="triggerSet" />
							</div>	
						</div>
						
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Top Navigation Text Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="navtxtcolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_NAVTXTCOLOR')).'" class="triggerSet" />
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Top Navigation Hover Text Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="navhicolor" value="'.Tools::safeOutput(Configuration::get('EB_THEME_NAVHICOLOR')).'" class="triggerSet" />
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Top Navigation Expand Effect').'
							</label>
							<div class="col-lg-9">
								<select name="navdisplay">
									<option value="mega" '.Tools::safeOutput(Configuration::get('EB_THEME_NAVDISPLAY') == 'mega' ? ' selected="selected"' : '').'>Mega-Menu</option>
									<option value="drop" '.Tools::safeOutput(Configuration::get('EB_THEME_NAVDISPLAY') == 'drop' ? ' selected="selected"' : '').'>Drop-Down</option>
									<option value="none" '.Tools::safeOutput(Configuration::get('EB_THEME_NAVDISPLAY') == 'none' ? ' selected="selected"' : '').'>Simple No-Drop</option>
								</select>
							</div>
						</div>
					</div>
				</fieldset>
				
				<fieldset class="form-group">
					<legend> 
						<i class="icon-chevron-down"></i>
						'.$this->l('Footer Options').'
						<a href="#" class="icon-plus icon-right"></a>
					</legend>
					<div class="group-block">
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Footer background Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="topfooterbg" value="'.Tools::safeOutput(Configuration::get('EB_THEME_TOPFOOTERBG')).'" class="triggerSet" />
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Footer Link Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="topfooterlink" value="'.Tools::safeOutput(Configuration::get('EB_THEME_TOPFOOTERLINK')).'" class="triggerSet" />
							</div>	
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Footer Text Color').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="topfootertxt" value="'.Tools::safeOutput(Configuration::get('EB_THEME_TOPFOOTERTXT')).'" class="triggerSet" />
							</div>	
						</div>
					</div>
				</fieldset>
				
				<!--
				<fieldset class="form-group">
					<legend> 
						'.$this->l('Other Options').'
					</legend>
					<div class="group-block">
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Round Corners').'
							</label>
							<div class="col-lg-9">
								<input type="text" name="radius" value="'.Tools::safeOutput(Configuration::get('EB_THEME_RADIUS')).'" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-3">
								'.$this->l('Hide Quick Buy in Product Listing').'
							</label>
							<div class="col-lg-9">
								<input type="checkbox" name="quickbuy" value="hide" '.Tools::safeOutput(Configuration::get('EB_THEME_QUICKBUY') ==  'hide' ? ' checked="checked"' : '').'>
							</div>
						</div>
					</div>
				</fieldset>
				-->
				<center>
					<button type="submit" value="1" name="submitEbThemeController" value="'.$this->l('Save').'" class="btn btn-default pull-right">
						<i class="process-icon-save"></i> Save
					</button>
				</center>
			</fieldset>
			</div>
		</form>';
		return $this->_output;
	}
        
        
/*-------------------------------------------------------------*/
/*  PREPARE FOR HOOK
/*-------------------------------------------------------------*/          

        private function _prepHook($params){
                       
			/* Variables */
           $themeversion = Configuration::get('EB_THEME_VERSION');
           $this->smarty->assign('themeversion', $themeversion);
			$hovercolor = Configuration::get('EB_THEME_HOVERCOLOR');
           $this->smarty->assign('hovercolor', $hovercolor);
			$hover = Configuration::get('EB_THEME_HOVER');
           $this->smarty->assign('hover', $hover);
			$themelayout = Configuration::get('EB_THEME_LAYOUT');
           $this->smarty->assign('themelayout', $themelayout);
           $bgcolor = Configuration::get('EB_THEME_BGCOLOR');
           $this->smarty->assign('bgcolor', $bgcolor);
			$hicolor = Configuration::get('EB_THEME_HICOLOR');
           $this->smarty->assign('hicolor', $hicolor);
		   
			$headbgcolor = Configuration::get('EB_THEME_HEADBGCOLOR');
           $this->smarty->assign('headbgcolor', $headbgcolor);
			$headtxtcolor = Configuration::get('EB_THEME_HEADTXTCOLOR');
           $this->smarty->assign('headtxtcolor', $headtxtcolor);
			$headhicolor = Configuration::get('EB_THEME_HEADHICOLOR');
           $this->smarty->assign('headhicolor', $headhicolor);
		   
			$txtcolor = Configuration::get('EB_THEME_TXTCOLOR');
           $this->smarty->assign('txtcolor', $txtcolor);
			$linkcolor = Configuration::get('EB_THEME_LINKCOLOR');
           $this->smarty->assign('linkcolor', $linkcolor);
			$headcolor = Configuration::get('EB_THEME_HEADCOLOR');
           $this->smarty->assign('headcolor', $headcolor);
			$btncolor = Configuration::get('EB_THEME_BTNCOLOR');
           $this->smarty->assign('btncolor', $btncolor);
			$btntxt = Configuration::get('EB_THEME_BTNTXT');
           $this->smarty->assign('btntxt', $btntxt);
			$btncolorover = Configuration::get('EB_THEME_BTNCOLOROVER');
           $this->smarty->assign('btncolorover', $btncolorover);
			$btntxtover = Configuration::get('EB_THEME_BTNTXTOVER'); 
           $this->smarty->assign('btntxtover', $btntxtover);
			$topfooterbg = Configuration::get('EB_THEME_TOPFOOTERBG');
           $this->smarty->assign('topfooterbg', $topfooterbg);
			$topfooterlink = Configuration::get('EB_THEME_TOPFOOTERLINK');
           $this->smarty->assign('topfooterlink', $topfooterlink);
			$topfootertxt = Configuration::get('EB_THEME_TOPFOOTERTXT');
           $this->smarty->assign('topfootertxt', $topfootertxt);
			$navbgcolor = Configuration::get('EB_THEME_NAVBGCOLOR');
           $this->smarty->assign('navbgcolor', $navbgcolor);
			$navbghicolor = Configuration::get('EB_THEME_NAVBGHICOLOR');
           $this->smarty->assign('navbghicolor', $navbghicolor);
			$navtxtcolor = Configuration::get('EB_THEME_NAVTXTCOLOR');
           $this->smarty->assign('navtxtcolor', $navtxtcolor);
			$navhicolor = Configuration::get('EB_THEME_NAVHICOLOR');
           $this->smarty->assign('navhicolor', $navhicolor);
			$navdisplay = Configuration::get('EB_THEME_NAVDISPLAY');
           $this->smarty->assign('navdisplay', $navdisplay);
			$radius = Configuration::get('EB_THEME_RADIUS');
			$this->smarty->assign('radius', $radius);
			$fontsbody = Configuration::get('EB_THEME_FONTSBODY');
           $this->smarty->assign('fontsbody', $fontsbody);
			$fontshead = Configuration::get('EB_THEME_FONTSHEAD');
           $this->smarty->assign('fontshead', $fontshead);
			$quickbuy = Configuration::get('EB_THEME_QUICKBUY');
           $this->smarty->assign('quickbuy', $quickbuy);
			
           $ebThemeRender = $this->display(__FILE__, 'ebthemecontroller.tpl');
           $this->smarty->assignGlobal('ebThemeRender', $ebThemeRender);
            
        }
        
        
/*-------------------------------------------------------------*/
/*  HOOK (displayHeader)
/*-------------------------------------------------------------*/
        
        public function hookDisplayHeader ($params){
            $this->_prepHook($params);            
        }
        
}