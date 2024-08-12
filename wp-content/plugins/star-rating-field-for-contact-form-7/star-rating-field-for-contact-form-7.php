<?php
/*
  Plugin Name: Star Rating Field For Contact Form 7
  Description: This plugin allows create star rating For Contact Form 7  plugin.
  Version: 1.0
  Copyright: 2023
  Text Domain: star-rating-field-for-contact-form-7
*/

if (!defined('ABSPATH')) {
    die('-1');
}

// define for base name
if (!defined('SRFFCF7_BASE_NAME')) {
    define('SRFFCF7_BASE_NAME', plugin_basename(__FILE__));
}

// define for plugin file
if (!defined('srffcf7_plugin_file')) {
    define('srffcf7_plugin_file', __FILE__);
}

if (!defined('SRFFCF7_PLUGIN_DIR')) {
    define('SRFFCF7_PLUGIN_DIR', plugin_dir_path(__FILE__));
}
if (!defined('SRFFCF7_PLUGIN_URL')) {
  define('SRFFCF7_PLUGIN_URL',plugins_url('', __FILE__));
}
// Include function files
include_once(SRFFCF7_PLUGIN_DIR.'includes/frontend.php');
include_once(SRFFCF7_PLUGIN_DIR.'includes/admin.php');

function SRFFCF7_load_script_style(){
    wp_enqueue_script( 'jquery-raty', SRFFCF7_PLUGIN_URL . '/public/jquery.rating/jquery.raty.js', array('jquery'), '2.0');
    wp_enqueue_script( 'jquery-rating', SRFFCF7_PLUGIN_URL. '/public/js/design.js', array('jquery'), '1.0');
    
    wp_localize_script( 'jquery-rating', 'student_ajax', array( 'ajax_urla' => SRFFCF7_PLUGIN_URL) );

    wp_enqueue_style( 'jquery-rating-style', SRFFCF7_PLUGIN_URL. '/public/jquery.rating/jquery.raty.css', '', '3.0' );
}
add_action( 'wp_enqueue_scripts', 'SRFFCF7_load_script_style' );