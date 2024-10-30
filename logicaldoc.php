<?php
/*
Plugin Name: LogicalDOC WordPress Explorer
Plugin URI: https://wiki.logicaldoc.com/wiki/LogicalDOC_WordPress_Explorer
Description: LogicalDOC is a document management software that is designed to handle and share documents within an organization. This plugin allows you to expose in a controlled way a portion of the document repository in WordPress, allowing folder browsing, document downloading and full-text search.
Version: 1.0.10
Author: LogicalDOC Team
Author URI: https://www.logicaldoc.com
License: GPLv2 or later
Text Domain: logicaldoc
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function ldoc_enqueue_scripts() {
    wp_register_style('datatables', plugins_url('assets/css/datatables/datatables.ui.css', __FILE__));
    wp_register_style('jquery-custom-ui', plugins_url('assets/css/themes/jquery-ui-1.8.23.custom.css', __FILE__));
    wp_register_style('validationEngine', plugins_url('assets/css/validationEngine.jquery.css', __FILE__));    
    wp_register_style('inline', plugins_url('assets/css/inline.css', __FILE__));
    wp_register_style('logicaldoc', plugins_url('assets/css/logicaldoc.css', __FILE__));
    
    wp_enqueue_style('datatables');
    wp_enqueue_style('jquery-custom-ui');
    wp_enqueue_style('validationEngine');
    wp_enqueue_style('inline');
    wp_enqueue_style('logicaldoc');    

    wp_register_script('validationEngine-en', plugins_url('assets/js/validator/jquery.validationEngine-en.js', __FILE__), array('jquery'), '2.6.5', true);
    wp_register_script('validationEngine', plugins_url('assets/js/validator/jquery.validationEngine.js', __FILE__), array('jquery'), '2.6.5', true);
    wp_register_script('datatables', plugins_url('assets/js/jquery.dataTables-1.9.4.js', __FILE__), array('jquery'), '1.9.4', true);
    wp_register_script('logicaldoc', plugins_url('assets/js/logicaldoc.js', __FILE__), array('jquery'), '1.0', true);
  
    wp_enqueue_script('jquery'); 
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-widget');
    wp_enqueue_script('jquery-ui-button');
    wp_enqueue_script('jquery-ui-tabs'); 
   
    wp_enqueue_script('validationEngine-en');
    wp_enqueue_script('validationEngine');
    wp_enqueue_script('datatables');
    wp_enqueue_script('logicaldoc');
}


add_action( 'wp_enqueue_scripts', 'ldoc_enqueue_scripts' );  

require_once('init.php');

require_once('custom-post.php');

require_once('custom-fields.php');

require_once('ajax-handle.php');

require_once('Controller/configuration.php');

require_once('shortcode.php');



