<?php
//ini_set('display_errors', 1);
/* 
 * After create a user account
 * insert the kudobuzz javascript in the front head
 */

//Include config file
require_once '../includes/config.php';
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

$user_id = $_GET['user_id'];

$url = MAIN_HOST .'user/get_user?user_id='.$user_id.'&include_entities=1';

//Get the user account id
$user_account_details = json_decode(file_get_contents($url));

$account_id = $user_account_details->id;

//Get uid
$url_uid = MAIN_HOST .'user/get_uid?user_id='.$user_id.'&account_id='.$account_id;

$uid = json_decode(file_get_contents($url_uid));
update_option('kudobuzz_uid', $uid); 