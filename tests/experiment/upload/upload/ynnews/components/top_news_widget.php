<?php


/**
 * 
 * @copyright       [YOUNET_COPPYRIGHT]
 * @author          MinhTA
 * @package         Module_ynnews
 */

class YNNEWS_CMP_TopNewsWidget extends OW_Component
{
	public function __construct( BASE_CLASS_WidgetParameter $paramObject )
    {
        parent::__construct();
    }
 	
 	// If you redefine this method, you'll be able to add fields to the widget configuration form 
    public static function getSettingList() 
    {
        $settingList = array();
       
 
        return $settingList;
    }
 
 	// This method is called before saving the widget settings. Here you can process the settings entered by a user before saving them. 
    public static function processSettingList( $settings, $place , $isAdmin) 
    {
        
 
        return $settings;
    }

 	// If you redefine this method, you will be able to set default values for the standard widget settings. 
    public static function getStandardSettingValueList() 
    {

    	//this array is needed to be initilized with some values 
        return array(
        );
    }

 	// If you redefine this method, you'll be able to manage the widget visibility 
    public static function getAccess() 
    {
        return self::ACCESS_ALL;
    }
 	
 	// The standard method of the component that is called before rendering
    public function onBeforeRender() 
    {

    }
}