<?php

/*
Plugin Name: Kudobuzz
Plugin URI: https://kudobuzz.com
Description: Kudobuzz is a simple widget that displays selected positive social buzz, or “kudos”, on your website. Kudubag makes your website more customer-centric while improving your SEO.
Version: 1.1
Author: Kudobuzz
Author URI: https://kudobuzz.com
License: GPL
*/


//Adding the Menu Block
add_action( 'admin_menu', 'register_kudobuzz_menu_page' );
add_action('admin_menu', 'register_kudobuzz_submenu_page');
add_action('wp_footer', 'add_widget');
add_action('admin_head', 'get_id');
add_action('admin_footer', 'signup_listener');

add_action('init', 'sessionStart', 1);
add_action('wp_logout', 'sessionEnd');

function sessionStart() {
    if(!session_id()) {
        session_start();
    }
}

function sessionEnd() {
    session_destroy ();
}

//action hook for plugin activation
register_activation_hook(__FILE__, 'activate_kudobuzz_plugin');
//action hook for plugin activation
register_deactivation_hook(__FILE__, 'deactivate_kudobuzz_plugin');

//Deactivate plugin
function deactivate_kudobuzz_plugin() {
delete_option('kudobuzz_uid', '');
delete_option('kudobuzz_div','');
}

//Activate plugin
function activate_kudobuzz_plugin() {
 add_option ('kudobuzz_div', '<div id="kudobuzz_widget"></div>');
 add_option('kudobuzz_uid', '');
 delete_option('kudobux','');
 delete_option('kudobag','');
}


$script = "<script src=\"https://kudobuzz.com/assets/javascripts/kudos/widget.js\"></script><script> Kudos.Widget({uid: '".get_option( 'kudobuzz_uid' )."'});</script>"; 



function set_shortcode($atts) {

    $our_div = "";
    
    $our_div .= get_option( 'kudobuzz_div' );

    return  $our_div;
}

//Add shortcode 
add_shortcode("kudobuzz", 'set_shortcode');

function register_kudobuzz_menu_page(){
    
    add_menu_page(__('Kudobuzz_menu','Kudobuzz'), __('  Kudobuzz','kudos-menu'), 'manage_options', 'Kudobuzz', 'kudobuzz_plugin_default',plugins_url( 'kudobux-testimonial-widget/img/icon.png' ) );
}

function add_widget(){
  
  echo  $GLOBALS['script'];
}

function register_kudobuzz_submenu_page() {
add_submenu_page('Kudobuzz', __('Kudobuzz-Customize','Sign up'), __('Sign up','kudos-signup'), 'manage_options', 'Sign_up', 'kudobuzz_sign_up');
add_submenu_page('Kudobuzz', __('Kudobuzz-Customize','Customize Widget'), __('Customize Widget','kudos-widget'), 'manage_options', 'customize-widget', 'kudobuzz_customize_widget');
add_submenu_page('Kudobuzz', __('Kudobuzz-Customize','Setup'), __('Setup','kudos-setup'), 'manage_options', 'setup', 'kudobuzz_setup');
}


//Loading a page in Ifram to help customize the widget
function kudobuzz_plugin_default() {
 
 
 if(!isset($_SESSION['first_time'])) {
   $_SESSION['first_time'] = "first_time";
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'|| $_SERVER['SERVER_PORT'] == 443) {

         	$url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}else{
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	echo '<div class="wrap">';
	echo'<iframe src="https://kudobuzz.com/logout?platform=1&url='.urlencode($url).'" width="1020" height="800"></iframe>';
	echo '</div>';
} else {
    if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'|| $_SERVER['SERVER_PORT'] == 443) {

         	$url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}else{
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	echo '<div class="wrap">';
	echo '<iframe src="https://kudobuzz.com/login?platform=1&url='.urlencode($url).'" width="1020" height="800"></iframe>';
	echo '</div>';
}
 
	
}

function kudobuzz_sign_up(){
if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'|| $_SERVER['SERVER_PORT'] == 443) {

         	$url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}else{
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
echo '<div class="wrap">';
	echo '<iframe src="https://kudobuzz.com/signup/add_channel?platform=1&url='.urlencode($url).'" width="1100" height="900"></iframe>';
	echo '</div>';
}

function kudobuzz_customize_widget() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'|| $_SERVER['SERVER_PORT'] == 443) {

         	$url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}else{
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	echo '<div class="wrap">';
	echo '<iframe src="https://kudobuzz.com/dashboard/customize" width="1020" height="800"></iframe>';
	echo '</div>';
}

function kudobuzz_setup(){
if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<h1>How to Setup Kudobuzz Wp-plugin</h1>

<ol>
<li>You will need to create a Kudobuzz Account using the sign-up menu</li>
<li><p>Confirm your email address afterwards and login to your dashboard.</p>
<p>
<li><p>Connect the Facebook and/or the Twitter account you want to collect testimonials(Kudos) from. Mostly your business account.
Within a few seconds Kudobuzz will start pulling all the postive things people have said about you if any.</p>
<p>If you don\'t have any social account or no kudos in there. Don\'t worry use the Customer Kudos button to add personal Kudos.
Click on the Kudos you want to feature on from the left hand-side they will show up in your kudo bag.</p></li>
<li><p>To use wordpress shortcode choose template 3 or 4 (embedable widget), for floating go for 1 or 2.
Next customize the look and feel of the template to much your blog theme. Click on save or Next to continue
If you selected template 1 or 2 you are done. You don\'t need to do any other thing</li>
<li>If you selected template 3 or 4 grab this code and paste it anywhere you want to show the testimonials</p></li>
<h2><blockquote><b>[kudobuzz] </b> </blockquote></h2>
</p>
<li>  You are ready to rock-n-roll :)</li></ol>';
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
  if( update_option( "kudobuzz_uid", $new_value ) ) {
 $GLOBALS['script'] = "<script src=\"https://kudobuzz.com/assets/javascripts/kudos/widget.js\"></script><script> Kudos.Widget({uid: '".$new_value ."'});</script>"; 
  	add_action('wp_footer', 'add_widget');
    //print_r(1);
    exit();
  } 
  //print_r(0);
  exit();
}

add_action( "wp_ajax_nopriv_update_kudos_key", "update_kudos_key" ); // Works for users not logged in
add_action( "wp_ajax_update_kudos_key", "update_kudos_key" ); // Works for users who are logged in

function signup_listener(){
echo '<script>
        window.addEventListener( "message",
          function (e) {
                if(e.origin !== "https://kudobuzz.com"){ return; } 
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