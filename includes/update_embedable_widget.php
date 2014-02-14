<?php

ini_set('display_errors', 1);

/* 
 * After create a user account
 * insert the kudobuzz javascript in the front head
 */

//Include config file
require_once '../includes/config.php';
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

$user_id = $_POST['user_id'];
$widget_type_id = $_POST['widget_type_id'];

if($widget_type_id == '8'){
    update_option('full_page_widget_added', $widget_type_id);
}
elseif($widget_type_id == '9'){
    update_option('slider_widget_added', $widget_type_id);
}