<?php

/*
  Plugin Name: Kudobuzz
  Plugin URI: https://kudobuzz.com
  Description: Kudobuzz is a simple widget that displays selected positive social buzz, or “kudos”, on your website. Collect reviews from your visits. Kudubuzz makes your website more customer-centric while improving your SEO.
  Version: 1.2.5
  Author: Kudobuzz
  Author URI: https://kudobuzz.com
  License: GPL
 */

if (!function_exists('add_action')) {
    echo "Hi there!  You are in a wrong place";
    exit();
}

//Required config file 
require_once plugin_dir_path(__FILE__) . 'includes/config.php';

//Check if the user has
$kd_uid = get_option('kudobuzz_uid');

/* * ******************************
 * When user activate the plugin
 * ***************************** */

register_activation_hook(__FILE__, 'activate_kudobuzz_plugin');

add_action('admin_init', 'kudobuzz_plugin_redirect');

function kudobuzz_plugin_redirect() {
    if (get_option('kudobuzz_activation_redirect', false)) {
        delete_option('kudobuzz_activation_redirect');

        //Checkin if we should initialize the kudobuzz_uid to 0 or not
        $possible_existing_uid = get_option('kudobuzz_uid');

        if (isset($possible_existing_uid) && $possible_existing_uid !== FALSE && !empty($possible_existing_uid)) {
            wp_redirect('admin.php?page=Returning-user');
            exit();
        } else {
            //CREATE A NEW EMPTY uid
            wp_redirect('admin.php?page=Signup');
            exit();
        }
    }
}

/*
 * Trigger function when user activate plugin
 */

function activate_kudobuzz_plugin() {
    add_option('kudobuzz_fullpage_widget', '<div id="kudobuzz-fullpage-widget"></div>');
    add_option('kudobuzz_slider_widget', '<div id="kudobuzz-slider-widget"></div>');
    add_option('kudobuzz_contact_widget', '<div id="kudobuzz-contact-widget"></div>');

    add_option('kudobuzz_login_url', MAIN_HOST . 'login');
    add_option('kudobuzz_activation_redirect', true);
    add_option('kudobuzz_uid', '');
    add_option('slider_widget_added', 0);
    add_option('full_page_widget_added', 0);
    add_action('signin_form', 'sign_up');
    add_action('admin_menu', 'add_submenu_page');
}

/* * ********************************
 * When user deactivate the plugin
 * ******************************* */
register_deactivation_hook(__FILE__, 'deactivate_kudobuzz_plugin');

/*
 * Trigger function when user deactivate plugin
 */

function deactivate_kudobuzz_plugin() {
    //delete_option('kudobuzz_uid');
    delete_option('kudobuzz_div');
    delete_option('kudobuzz_login_url');
    delete_option('kudobuzz_activation_redirect');
    delete_option('kudobuzz_fullpage_widget');
    delete_option('kudobuzz_slider_widget');
    delete_option('kudobuzz_contact_widget');
    delete_option('slider_widget_added');
    delete_option('full_page_widget_added');
}

//Plugin Directory Link
define('Kudobuzz_Plugin_DIR', plugin_dir_path(__FILE__));
define('Kudobuzz_Plugin_URL', plugin_dir_url(__FILE__));
add_action('admin_menu', 'register_kudobuzz_menu_page');

//Define some basic variables
define('ACFSURL', WP_PLUGIN_URL . "/" . dirname(plugin_basename(__FILE__)));
define('ACFPATH', WP_PLUGIN_DIR . "/" . dirname(plugin_basename(__FILE__)));

/*
 * Add javascripts files
 */

function wpd_add_kudobuzz_javascript_files() {
    //Jquery
    wp_enqueue_script('jquery-js', plugins_url('kudobux-testimonial-widget/assets/js/jquery-1.7.2.min.js', dirname(__FILE__)));

    //Bootstrap
    wp_enqueue_script('bootstrap-js', plugins_url('kudobux-testimonial-widget/assets/js/bootstrap.min.js', dirname(__FILE__)));

    //Bootbox
    wp_enqueue_script('bootbox-js', plugins_url('kudobux-testimonial-widget/assets/js/bootbox.min.js', dirname(__FILE__)));
}

add_action('admin_enqueue_scripts', 'wpd_add_kudobuzz_javascript_files');

/*
 * Add the css files to the admin header
 */

function wpd_add_kudobuzz_css_files() {
    //Main css file
    wp_register_style('main-css', plugins_url('kudobux-testimonial-widget/assets/css/main.css', dirname(__FILE__)), false, '1.0.0');
    wp_enqueue_style('main-css');

    //bootstrap css file
    wp_register_style('bootstrap-css', plugins_url('kudobux-testimonial-widget/assets/css/bootstrap.css', dirname(__FILE__)), false, '1.0.0');
    wp_enqueue_style('bootstrap-css');
}

add_action('admin_enqueue_scripts', 'wpd_add_kudobuzz_css_files');


/*
 * Set menu
 */

function register_kudobuzz_menu_page() {
    add_menu_page(__('kudobuzz_menu', 'Kudobuzz'), __('Kudobuzz', 'kudos-menu'), 'manage_options', 'Kudobuzz', 'signin_now', plugins_url('kudobux-testimonial-widget/assets/img/kudo_head.png'));

    //Sign up
    add_submenu_page('kudobuzz_menu', 'Signup', 'Signup', 'manage_options', 'Signup', 'signup_now');

    //Signin
    add_submenu_page('kudobuzz_menu', 'Login', 'Login', 'manage_options', 'Signin', 'signin_now');

    //A returning user 
    add_submenu_page('kudobuzz_menu', 'Returning user', 'Returning user', 'manage_options', 'Returning-user', 'returnin_user');

    //After registration
    add_submenu_page('kudobuzz_menu', 'Success Page', 'Success Page', 'manage_options', 'Success', 'go_success_page');

    //Inject code in the head tag
    add_submenu_page('kudobuzz_menu', 'Inject code in the head tag', 'Inject code in the head tag', 'manage_options', 'Inject_code', 'inject_code');

    //Go to dashboard
    add_submenu_page('Kudobuzz', 'Dashboard', 'Dashboard', 'manage_options', 'Kudobuzz');

    //Update uid
    add_submenu_page('kudobuzz_menu', 'Update account', 'Update account', 'manage_options', 'ReconnectYourAccount', 'update_account');

    //Udpate uid script
    add_submenu_page('kudobuzz_menu', 'Update Uid', 'Update Uid', 'manage_options', 'updateUid', 'update_uid');

    //Other links
    add_submenu_page('Kudobuzz', 'Connect Social Accounts', 'Add Social Accounts', 'manage_options', 'ConnectSocialAccount', 'connect_social_account');
    add_submenu_page('Kudobuzz', 'Add Custom Review', 'Add Custom Review', 'manage_options', 'AddCustomReview', 'add_custom_review');
    add_submenu_page('Kudobuzz', 'Moderate Reviews', 'Moderate Reviews', 'manage_options', 'ModerateReviews', 'social_reviews');
    add_submenu_page('Kudobuzz', 'Customize Widget', 'Customize Widgets', 'manage_options', 'CustomizeWidget', 'customize_widget');
    add_submenu_page('Kudobuzz', 'Short Codes', 'Short Codes', 'manage_options', 'ShortCodes', 'short_codes');
}

function short_codes() {

    include( plugin_dir_path(__FILE__) . '/includes/shortcodes.php');
}

function update_uid() {
    $user_id = $_GET['user_id'];
    $account_id = $_GET['account_id'];

    //Get uid
    $url_uid = MAIN_HOST . 'user/get_uid?user_id=' . $user_id . '&account_id=' . $account_id;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_uid);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSLVERSION, 3);

    $uid = json_decode(curl_exec($ch));
  
    curl_close($ch);
    
    update_option('kudobuzz_uid', $uid);
}

/*
 * Update account
 */

function update_account() {

    include( plugin_dir_path(__FILE__) . '/includes/update-account.php');
}

/*
 * Customize widget
 */

function customize_widget() {
//    $admin_email = get_settings("admin_email");
//    $user_details_url = MAIN_HOST . 'user/get_user?email=' . urlencode($admin_email) . '&include_entities=1';
//    $user_details = json_decode(file_get_contents($user_details_url));
    $possible_existing_uid = get_option('kudobuzz_uid');

    if (isset($possible_existing_uid) && $possible_existing_uid !== FALSE && !empty($possible_existing_uid)) {
        include( plugin_dir_path(__FILE__) . '/includes/customize-widget.php');
    } else {
        include( plugin_dir_path(__FILE__) . '/includes/new-user-form.php');
    }
}

/*
 * Add custom review
 */

function add_custom_review() {
    $possible_existing_uid = get_option('kudobuzz_uid');

    if (isset($possible_existing_uid) && $possible_existing_uid !== FALSE && !empty($possible_existing_uid)) {
        include( plugin_dir_path(__FILE__) . '/includes/add-custom-reviews.php');
    } else {
        include( plugin_dir_path(__FILE__) . '/includes/new-user-form.php');
    }
}

/*
 * Connect social account
 */

function connect_social_account() {
  $possible_existing_uid = get_option('kudobuzz_uid');
    if (isset($possible_existing_uid) && $possible_existing_uid !== FALSE && !empty($possible_existing_uid)) {
        include( plugin_dir_path(__FILE__) . '/includes/connects-social-account.php');
    } else {
        include( plugin_dir_path(__FILE__) . '/includes/new-user-form.php');
    }
}

/*
 * 
 */

function social_reviews() {
    
    $possible_existing_uid = get_option('kudobuzz_uid');

    if (isset($possible_existing_uid) && $possible_existing_uid !== FALSE && !empty($possible_existing_uid)) {
        $account_name = $user_details->account_name;
        include( plugin_dir_path(__FILE__) . '/includes/social_reviews.php');
    } else {
        include( plugin_dir_path(__FILE__) . '/includes/new-user-form.php');
    }
}

/*
 * Signup form
 */

function signup_now() {
    include( plugin_dir_path(__FILE__) . '/includes/new-user-form.php');
}

/*
 * Signin form
 */

function signin_now() {//returnin_user
    
    $possible_existing_uid = get_option('kudobuzz_uid');
    
    if (isset($possible_existing_uid) && $possible_existing_uid !== FALSE && !empty($possible_existing_uid)) {
        include( plugin_dir_path(__FILE__) . '/includes/login.php');
    } else {
        include( plugin_dir_path(__FILE__) . '/includes/new-user-form.php');
    }
}

/*
 * Returning user
 */

function returnin_user() {
    include( plugin_dir_path(__FILE__) . '/includes/returning_user.php');
}

/*
 * Success page
 */

function go_success_page() {
    include( plugin_dir_path(__FILE__) . '/includes/success.php');
}

/*
 * Inject code
 */

function inject_code() {
    include( plugin_dir_path(__FILE__) . '/includes/after-user-registration.php');
}

$uid2 = get_option('kudobuzz_uid');

if (isset($uid2) && $uid2 !== FALSE && !empty($uid2)) {
    $script = "<!--Start Kudobuzz Here --> <script src='" . MAIN_HOST . "public/javascripts/kudos/widget.js'></script><script> Kudos.Widget({uid: '" . get_option('kudobuzz_uid') . "'});</script><!--End Kudobuzz Here -->";

//Get embedable widgets
    $slider_widget_added = get_option('slider_widget_added');
    $full_page_widget_added = get_option('full_page_widget_added');

    function add_widget() {

        echo $GLOBALS['script'];
    }

    add_action('wp_head', 'add_widget');
}

/**
 * Set code full page
 */
add_shortcode("kudobuzz-fullpage", 'set_fullpage_shortcode');

function set_fullpage_shortcode($atts) {
    $kudobuzz_fullpage_tag = "";
    $kudobuzz_fullpage_tag .= get_option("kudobuzz_fullpage_widget");
    return $kudobuzz_fullpage_tag;
}

/**
 * Set code slider
 */
add_shortcode("kudobuzz-slider", "set_slider_shortcode");

function set_slider_shortcode($atts) {
    $kudobuzz_slider_tag = "";
    $kudobuzz_slider_tag .= get_option("kudobuzz_slider_widget");
    return $kudobuzz_slider_tag;
}
