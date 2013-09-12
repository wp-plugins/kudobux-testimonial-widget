<?php

/*
Plugin Name: Kudobag
Plugin URI: https://kudobag.com/
Description: A simple Social Testimonial Widget
Version: 1.0
Author: Kudobag
Author URI: https://kudobag.com
License: GPL
*/

//Adding the Menu Block
add_action( 'admin_menu', 'register_my_kudobag_menu_page' );
add_action('admin_menu', 'register_my_kudobag_submenu_page');
add_action('wp_footer', 'add_widget');
add_action('admin_head', 'get_id');
add_action('admin_footer', 'signup_listener');
$script = "<script src=\"https://kudobag.com/assets/javascripts/kudos/widget.js\"></script><script> Kudos.Widget({uid: '".get_option( 'kudobag_uid' )."'});</script>"; 

function register_my_kudobag_menu_page(){
    
    add_menu_page(__('Kudobag_menu','Kudobag'), __('  Kudobag','kudos-menu'), 'manage_options', 'Kudobag', 'kudobag_plugin_default',plugins_url( 'kudobux-testimonial-widget/img/icon.png' ) );
}

function add_widget(){
  try{add_option('kudobag_uid', '');}catch(Exception $e){}
  echo  $GLOBALS['script'];
}

function register_my_kudobag_submenu_page() {
add_submenu_page('Kudobag', __('Kudobag-Customize','Sign in'), __('Sign in','kudos-signin'), 'manage_options', 'Sign_in', 'kudobag_sign_in');
add_submenu_page('Kudobag', __('Kudobag-Customize','Customize Widget'), __('Customize Widget','kudos-widget'), 'manage_options', 'customize-widget', 'kudobag_customize_widget');
add_submenu_page('Kudobag', __('Kudobag-Customize','Help'), __('Help','kudos-help'), 'manage_options', 'help', 'kudobag_help');
}


//Loading a page in Ifram to help customize the widget
function kudobag_plugin_default() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	echo '<div class="wrap">';
	echo '<iframe src="https://kudobag.com/signup/add_channel?platform=1&url='.urlencode($url).'" width="1100" height="900"></iframe>';
	echo '</div>';
}

function kudobag_customize_widget() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	echo '<div class="wrap">';
	echo '<iframe src="https://kudobag.com/dashboard#customize" width="1020" height="800"></iframe>';
	echo '</div>';
}

function kudobag_sign_in() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	echo '<div class="wrap">';
	echo '<input hidden="input"  id="kudos_id" >';
echo '<iframe src="https://kudobag.com/login?platform=1&url='.urlencode($url).'" width="1020" height="800"></iframe>';
	echo '</div>';
}

function get_id(){
	echo   '<script type="text/javascript">function insert_id(string){
		var name=string;
		document.getElementById("kudos_id").value=name;
		}
 </script>';
}


function update_kudos_key( ) {
  // Error checking
  if( empty( $_POST ) or $_POST['uid'] == '' or ! $_POST['uid'] ) { print_r(0); exit(); }   

  $new_value = $_POST['uid'];

  // If we successfully update the uid ...
  if( update_option( "kudobag_uid", $new_value ) ) {
 $GLOBALS['script'] = "<script src=\"https://kudobag.com/assets/javascripts/kudos/widget.js\"></script><script> Kudos.Widget({uid: '".$new_value ."'});</script>"; 
  	add_action('wp_footer', 'add_widget');
    //print_r(1);
    exit();
  } 
  print_r(0);
  exit();
}

add_action( "wp_ajax_nopriv_update_kudos_key", "update_kudos_key" ); // Works for users not logged in
add_action( "wp_ajax_update_kudos_key", "update_kudos_key" ); // Works for users who are logged in

function signup_listener(){
echo '<script>
        window.addEventListener( "message",
          function (e) {
                if(e.origin !== "https://kudobag.com"){ return; } 
                $ = jQuery.noConflict();
 $( document ).ready( function() {
  $.post( ajaxurl, 
  { 
    action: \'update_kudos_key\',
    uid: e.data
  }, function( response ) {
   if( response == 1 ) {
   }
   else {
   }
  });
 } );            
                
          
          },
          false);
    </script>';

    
    
    
    
}





?>
