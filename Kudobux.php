<?php

/*
Plugin Name: Kudobux
Plugin URI: http://kudobux.com/
Description: A simple Social Testimonial Widget
Version: 1.0
Author: Kudobux
Author URI: https://kudobux.com
License: GPL
*/

//Adding the Menu Block
add_action( 'admin_menu', 'register_my_kudobux_menu_page' );
add_action('admin_menu', 'register_my_kudobux_submenu_page');
add_action('wp_footer', 'add_widget');
add_action('admin_head', 'get_id');
add_action('admin_footer', 'signup_listener');
$script = "<script src=\"http://kudobux.com/assets/javascripts/kudos/widget.js\"></script><script> Kudos.Widget({uid: '".get_option( 'kudobux_uid' )."'});</script>"; 

function register_my_kudobux_menu_page(){
    
    add_menu_page(__('Kudobux_menu','Kudobux'), __('  Kudobux','kudos-menu'), 'manage_options', 'Kudobux', 'kudobux_plugin_default',plugins_url( 'kudobux-testimonial-widget/img/icon.png' ) );
}

function add_widget(){
  try{add_option('kudobux_uid', '');}catch(Exception $e){}
  echo  $GLOBALS['script'];
}

function register_my_kudobux_submenu_page() {
add_submenu_page('Kudobux', __('Kudobux-Customize','Sign in'), __('Sign in','kudos-signin'), 'manage_options', 'Sign_in', 'kudobux_sign_in');
add_submenu_page('Kudobux', __('Kudobux-Customize','Customize Widget'), __('Customize Widget','kudos-widget'), 'manage_options', 'customize-widget', 'kudobux_customize_widget');
add_submenu_page('Kudobux', __('Kudobux-Customize','Help'), __('Help','kudos-help'), 'manage_options', 'help', 'kudobux_help');
}


//Loading a page in Ifram to help customize the widget
function kudobux_plugin_default() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	echo '<div class="wrap">';
	echo '<iframe src="http://kudobux.com/signup/add_channel?platform=1&url='.urlencode($url).'" width="1100" height="900"></iframe>';
	echo '</div>';
}

function kudobux_customize_widget() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	echo '<div class="wrap">';
	echo '<iframe src="http://kudobux.com/dashboard#customize" width="1020" height="800"></iframe>';
	echo '</div>';
}

function kudobux_sign_in() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	echo '<div class="wrap">';
	echo '<input hidden="input"  id="kudos_id" >';
echo '<iframe src="http://kudobux.com/login?platform=1&url='.urlencode($url).'" width="1020" height="800"></iframe>';
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
  if( update_option( "kudobux_uid", $new_value ) ) {
 $GLOBALS['script'] = "<script src=\"http://kudobux.com/assets/javascripts/kudos/widget.js\"></script><script> Kudos.Widget({uid: '".$new_value ."'});</script>"; 
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
                if(e.origin !== "http://kudobux.com"){ return; } 
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
