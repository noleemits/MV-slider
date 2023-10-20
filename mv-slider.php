<?php

/*
*Plugin name: MV Slider
*Plugin URI: https://wordpress.org/
*Description: Slider plugin
*Version: 1.0
*Requires at least: 6.0
*Author: Lee Hernandez
*Author URI: https://noleemits.agency
*License: GPL or later
*License URI: https://wordpress.org/about/license/
*Text Domain: mv-slider
*Domain Path: /languages
*/

if(! defined('ABSPATH')){
   exit;
}

if(! class_exists('MV_slider')){
    class MV_slider{
        function __construct()
        {
            $this->define_constants();
        }
        //define constants
        public function define_constants(){
         define('MV_SLIDER_PATH', plugin_dir_path(__FILE__));       
         define('MV_SLIDER_URL', plugin_dir_url(__FILE__));       
         define('MV_SLIDER_VERSION', '1.0.0');       
        }
     //activation hooks
     public  static function activate(){
        update_option( 'rewrite_rules', '' );
        
     }
     public  static function deactivate(){
        flush_rewrite_rules();
     }
     public static  function uninstall(){

     }

    }
}

if( class_exists('MV_slider')){
    register_activation_hook( __FILE__, array('MV_slider', 'activate') );
    register_deactivation_hook( __FILE__, array('MV_slider', 'deactivate') );
    register_uninstall_hook( __FILE__, array('MV_slider', 'uninstall') );
$mv_slider = new MV_slider();
}

