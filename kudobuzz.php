<?php

/*
  Plugin Name: Kudobuzz
  Plugin URI: https://kudobuzz.com
  Description: Kudobuzz is a simple widget that displays selected positive social buzz, or “kudos”, on your website. Collect reviews from your visits. Kudubuzz makes your website more customer-centric while improving your SEO.
  Version: 2.0.3
  Author: Kudobuzz
  Author URI: https://kudobuzz.com
  License: GPL
 */
session_start();
if (!function_exists('add_action')) {
    echo "Are you kidding me?";
    exit();
}


//Required config file 
require_once plugin_dir_path(__FILE__) . 'config.php';
require_once plugin_dir_path(__FILE__) . 'kudobuzzwp.php';
$kwp = new Kudobuzzwp();
//Check if the user has
$kd_uid = get_option('kudobuzz_uid');

//Try to get user details, if not successful, then redirect the user to the signup page
/*$user_account = $kwp->get_user($kd_uid);

if(isset($user_account->success) && $user_account->success == 0){
	header("location: qwer"); exit();
	//wp_redirect('admin.php?page=Signup');
	exit();
}*/



/* * ******************************
 * When user activate the plugin
 * ***************************** */

register_activation_hook(__FILE__, 'activate_kudobuzz_plugin');

add_action('admin_init', 'kudobuzz_plugin_redirect');

function kudobuzz_plugin_redirect() {
    
    //Unset sessions
//    unset($_SESSION['live-uid']);
//    unset($_SESSION['account-name']);
//    unset($_SESSION['url']);
//    unset($_SESSION['email']);
    
    if (get_option('kudobuzz_activation_redirect', false)) {
        delete_option('kudobuzz_activation_redirect');

        //Checkin if we should initialize the kudobuzz_uid to 0 or not
        $possible_existing_uid = get_option('kudobuzz_uid');
        

        if (isset($possible_existing_uid) && $possible_existing_uid !== FALSE && !empty($possible_existing_uid)) {

            require_once plugin_dir_path(__FILE__) . 'kudobuzzwp.php';
            $kwp = new Kudobuzzwp();

            //Cross check if the UID live is equal to the UID on localhost
            $admin_email = get_settings('admin_email');

            $user_details = json_decode($kwp->run_curl(API_DOMAIN . "user/get_user?email=" . $admin_email . "&include_entities=1", "GET"));
            
            $live_uid = $user_details->uid;
            $account_name = $user_details->account_name;
            $url = $user_details->url;

            if ($possible_existing_uid != $live_uid) { //update the localhost uid with the live uid
                
                //update_option('kudobuzz_uid', $live_uid);
                //Redirect the user to a page to confirm using the live details or create a new one
                $_SESSION['live-uid'] = $live_uid;
                $_SESSION['account-name'] = $account_name;
                $_SESSION['url'] = $url;
                $_SESSION['email'] = $admin_email;
                
                wp_redirect('admin.php?page=Confirm-account');
            }
            else{
                 wp_redirect('admin.php?page=Returning-user');
            }

             
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
    add_option('kudobuzz_test_url', MAIN_HOST . 'test');
    add_option('kudobuzz_activation_redirect', true);
    add_option('kudobuzz_uid', '');
    add_option('slider_widget_added', 0);
    add_option('full_page_widget_added', 0);
    add_action('signin_form', 'sign_up');
    add_action('admin_menu', 'add_submenu_page');

    create_full_page();
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

    $kudobuzz_page_title = get_option("kudobuzz_page_title");
    $kudobuzz_page_name = get_option("kudobuzz_page_name");

    //  the id of our page...
    $kudobuzz_page_id = get_option('kudobuzz_plugin_page_id');
    if ($kudobuzz_page_id) {

        wp_delete_post($kudobuzz_page_id); // this will trash, not delete
    }

    delete_option("kudobuzz_page_title");
    delete_option("kudobuzz_page_name");
    delete_option("kudobuzz_plugin_page_id");
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
    //wp_enqueue_script('jquery-js', plugins_url('kudobux-testimonial-widget/assets/js/jquery-1.7.2.min.js', dirname(__FILE__)));
    //wp_enqueue_script('jquery-js');
    
    wp_enqueue_script("jquery");

    if(is_admin()){
    	//Bootstrap
		wp_enqueue_script('bootstrap-js', plugins_url('kudobux-testimonial-widget/assets/js/bootstrap.min.js', dirname(__FILE__)));

		//Jany Bootstrap
		wp_enqueue_script('jany-bootstrap-js', plugins_url('kudobux-testimonial-widget/assets/js/jasny-bootstrap.min.js', dirname(__FILE__)));

		//Bootbox
		wp_enqueue_script('bootbox-js', plugins_url('kudobux-testimonial-widget/assets/js/bootbox.min.js', dirname(__FILE__)));

		//Nano scroller
		wp_enqueue_script('nano-scroller-js', plugins_url('kudobux-testimonial-widget/assets/js/jquery.nanoscroller.js', dirname(__FILE__)));

		//Rateit
		wp_enqueue_script('rateit-js', plugins_url('kudobux-testimonial-widget/assets/rateit/jquery.rateit.min.js', dirname(__FILE__)));

		//Bootstrap file upload
		wp_enqueue_script('bootstrap-file-upload-js', plugins_url('kudobux-testimonial-widget/assets/js/bootstrap-fileupload.min.js', dirname(__FILE__)));

		//Jquery form
		wp_enqueue_script('jquery-form-js', plugins_url('kudobux-testimonial-widget/assets/js/jquery.form.js', dirname(__FILE__)));

		//Jquery form
		wp_enqueue_script('user-update-js', plugins_url('kudobux-testimonial-widget/assets/js/user-update.js', dirname(__FILE__)));

		//Flat ui radio
		wp_enqueue_script('flatui-radio-js', plugins_url('kudobux-testimonial-widget/assets/js/flatui-radio.js', dirname(__FILE__)));
		
		//Flat ui checkbox
		wp_enqueue_script('flatui-checkbox-js', plugins_url('kudobux-testimonial-widget/assets/js/flatui-checkbox.js', dirname(__FILE__)));

		//Mini color
		wp_enqueue_script('mini-color-js', plugins_url('kudobux-testimonial-widget/assets/js/jquery.minicolors.js', dirname(__FILE__)));

		//bootstrap-switch
		wp_enqueue_script('bootstrap-switch-js', plugins_url('kudobux-testimonial-widget/assets/js/bootstrap-switch.js', dirname(__FILE__)));

		//bootstrap-switch
		wp_enqueue_script('bootstrap-tooltip-js', plugins_url('kudobux-testimonial-widget/assets/js/bootstrap-tooltip.js', dirname(__FILE__)));

		//manage_wdg
		wp_enqueue_script('manage_wdg-js', plugins_url('kudobux-testimonial-widget/assets/js/manage_wdg.js', dirname(__FILE__)));
    }
}

add_action('admin_enqueue_scripts', 'wpd_add_kudobuzz_javascript_files');

/*
 * Add the css files to the admin header bootstrap-switch
 */

function wpd_add_kudobuzz_css_files() {
    if(is_admin()){
    	//Main css file
		wp_register_style('main-css', plugins_url('kudobux-testimonial-widget/assets/css/main.css', dirname(__FILE__)), false, '1.0.0');
		wp_enqueue_style('main-css');

		//bootstrap css file
		wp_register_style('bootstrap-css', plugins_url('kudobux-testimonial-widget/assets/css/bootstrap.css', dirname(__FILE__)), false, '1.0.0');
		wp_enqueue_style('bootstrap-css');

		//Jany bootstrap css file
		wp_register_style('jany-bootstrap-css', plugins_url('kudobux-testimonial-widget/assets/css/jasny-bootstrap.css', dirname(__FILE__)), false, '1.0.0');
		wp_enqueue_style('jany-bootstrap-css');

		//Nano scroller
		wp_register_style('nanoscroller-css', plugins_url('kudobux-testimonial-widget/assets/css/nanoscroller.css', dirname(__FILE__)), false, '1.0.0');
		wp_enqueue_style('nanoscroller-css');

		//Rateit
		wp_register_style('rateit-css', plugins_url('kudobux-testimonial-widget/assets/rateit/rateit.css', dirname(__FILE__)), false, '1.0.0');
		wp_enqueue_style('rateit-css');

		//Rateit
		wp_register_style('bootstrap-file-upload', plugins_url('kudobux-testimonial-widget/assets/css/bootstrap-fileupload.min.css', dirname(__FILE__)), false, '1.0.0');
		wp_enqueue_style('bootstrap-file-upload');

		//Rateit
		wp_register_style('flat-ui', plugins_url('kudobux-testimonial-widget/assets/css/flat-ui.min.css', dirname(__FILE__)), false, '1.0.0');
		wp_enqueue_style('flat-ui');

		//Mini color
		wp_register_style('mini-color', plugins_url('kudobux-testimonial-widget/assets/css/jquery.minicolors.css', dirname(__FILE__)), false, '1.0.0');
		wp_enqueue_style('mini-color');
    }
}

add_action('admin_enqueue_scripts', 'wpd_add_kudobuzz_css_files');


/*
 * Set menu
 */

function register_kudobuzz_menu_page() {
    add_menu_page(__('kudobuzz_menu', 'Kudobuzz'), __('Kudobuzz', 'kudos-menu'), 'manage_options', 'Kudobuzz', 'moderate_reviews', plugins_url('kudobux-testimonial-widget/assets/img/kudo_head.png'));

    //Sign up
    add_submenu_page('kudobuzz_menu', 'Signup', 'Signup', 'manage_options', 'Signup', 'signup_now');

    //Signin
    add_submenu_page('kudobuzz_menu', 'Login', 'Login', 'manage_options', 'Signin', 'signin_now');

    //Test page
    add_submenu_page('kudobuzz_menu', 'Test', 'Test', 'manage_options', 'Test', 'test_page');

    //Moderate review page
    add_submenu_page('kudobuzz_menu', 'ModerateReviews', 'ModerateReviews', 'manage_options', 'ModerateReviews', 'moderate_reviews');

    //Moderate review page
    add_submenu_page('kudobuzz_menu', 'CustomizeTheme', 'CustomizeTheme', 'manage_options', 'CustomizeTheme', 'customize_theme');

    //Full page review page
    add_submenu_page('kudobuzz_menu', 'FullPageWidget', 'FullPageWidget', 'manage_options', 'FullPageWidget', 'full_page_wdg');

    //Add custom page page
    add_submenu_page('kudobuzz_menu', 'AddCustomReview', 'AddCustomReview', 'manage_options', 'AddCustomReview', 'add_custom_review');

    //Add SEO
    add_submenu_page('kudobuzz_menu', 'Seo', 'Seo', 'manage_options', 'Seo', 'seo_page');

    //Add SEO
    add_submenu_page('kudobuzz_menu', 'Settings', 'Settings', 'manage_options', 'Settings', 'settings_page');

    //A returning user 
    add_submenu_page('kudobuzz_menu', 'Returning user', 'Returning user', 'manage_options', 'Returning-user', 'returnin_user');
    
    //A returning user without uid
    add_submenu_page('kudobuzz_menu', 'Returning user', 'Returning user', 'manage_options', 'Returning-user-without-uid', 'returnin_user_without_uid');
    
    //I have forgotten my password
    add_submenu_page('kudobuzz_menu', 'Forgot password', 'Forgot password', 'manage_options', 'Forgot-password', 'forgot_pass');
    
    //Confirm account
    add_submenu_page('kudobuzz_menu', 'Confirm Account', 'Confirm Account', 'manage_options', 'Confirm-account', 'confirm_account');

    //After registration
    add_submenu_page('kudobuzz_menu', 'Success Page', 'Success Page', 'manage_options', 'Success', 'go_success_page');

    //Inject code in the head tag
    add_submenu_page('kudobuzz_menu', 'Inject code in the head tag', 'Inject code in the head tag', 'manage_options', 'Inject_code', 'inject_code');

    //Go to dashboard
    add_submenu_page('Kudobuzz', 'Moderate Review', 'Moderate Review', 'manage_options', 'Kudobuzz');
    add_submenu_page('Kudobuzz', 'Moderate Review', 'Moderate Review', 'manage_options', 'Kudobuzz');
	
	
    //Update uid
    add_submenu_page('kudobuzz_menu', 'Update account', 'Update account', 'manage_options', 'ReconnectYourAccount', 'update_account');

    //Udpate uid script
    add_submenu_page('kudobuzz_menu', 'Update Uid', 'Update Uid', 'manage_options', 'updateUid', 'update_uid');

    //Other links
    add_submenu_page('Kudobuzz', 'Connect Social Accounts', 'Customize Theme', 'manage_options', 'CustomizeTheme', 'connect_social_account');
    add_submenu_page('Kudobuzz', 'Add Custom Review', 'Add Custom Review', 'manage_options', 'AddCustomReview', 'add_custom_review');

    add_submenu_page('Kudobuzz', 'SEO', 'SEO', 'manage_options', 'SEO', 'seo_page');
    add_submenu_page('Kudobuzz', 'Settings', 'Settings', 'manage_options', 'Settings', 'settings');
    add_submenu_page('Kudobuzz', 'Translation', 'Translation', 'manage_options', 'Translation', 'translation');
    add_submenu_page('Kudobuzz', 'Installation Instruction', 'Installation Instruction', 'manage_options', 'InstallationInstruction', 'installation_instruction');
}

function short_codes() {

    include( plugin_dir_path(__FILE__) . '/includes/shortcodes.php');
}

function update_uid() {
    $user_id = $_GET['user_id'];
    $account_id = $_GET['account_id'];

    //Get uid
    $url_uid = MAIN_HOST . 'user/get_uid?user_id=' . $user_id . '&account_id=' . $account_id;

    $kwp = new Kudobuzzwp();

    $result = $kwp->run_curl($url_uid, "GET");
    $uid = json_decode($result);

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
 * Add custom review
 */

function seo_page() {
    include( plugin_dir_path(__FILE__) . '/includes/seo.php');
}

/*
 * Installation steps
 */
 function installation_instruction(){
 	
 	include( plugin_dir_path(__FILE__) . '/includes/installation-instruction.php');
 }

/*
 * Settings
 */

function settings_page() {
    include( plugin_dir_path(__FILE__) . '/includes/settings.php');
}

function translation() {
    include( plugin_dir_path(__FILE__) . '/includes/translation.php');
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
 * Confirm account
 */
function confirm_account(){ //Another uid found for
    
    include( plugin_dir_path(__FILE__) . '/includes/confirm_account.php');
}

/*
 * Returning user
 */

function returnin_user() {
    include( plugin_dir_path(__FILE__) . '/includes/returning_user.php');
}

/*
 * Returning user without uid
 */
function returnin_user_without_uid(){
    
    include( plugin_dir_path(__FILE__) . '/includes/returning_user_without_uid.php');
}

/*
 * Forgot password
 */
function forgot_pass(){
    
    include( plugin_dir_path(__FILE__) . '/includes/forgot-pass.php');
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

function add_rich_snippet_code() {
    echo '<div style="position: absolute !important;top: -9999px !important;left: -9999px !important;" itemscope itemtype="http://schema.org/Product"><span itemprop="name">'.get_option('site_review_domain').'</span><div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">Rated <span itemprop="ratingValue">'.get_option('site_review_rating').'</span>/5 based on <span itemprop="reviewCount">'.get_option('site_review_count').'</span> reviews</div>';
}
add_action('wp_footer', 'add_rich_snippet_code');

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

/*
 * Signin form
 */

function test_page() {//test
    include( plugin_dir_path(__FILE__) . '/includes/test.php');
}

/*
 * Moderate reviews
 */

function moderate_reviews() {

    include( plugin_dir_path(__FILE__) . '/includes/moderate_reviews.php');
}

/*
 * Customize theme
 */

function customize_theme() {

    include( plugin_dir_path(__FILE__) . '/includes/customize_theme.php');
}



/*
 * full page
 */

function full_page_wdg() {

    include( plugin_dir_path(__FILE__) . '/includes/full_page.php');
}

//Get Feeds
function get_feeds_options() {

    $kdwp = new Kudobuzzwp();

    $type = $_GET["type"];
    $page = $_GET["page"];
    $category = $_GET["category"];
    $social_filter = $_GET["social_filter"];
    $uid = $_GET["uid"];
    $total_connected = $_GET['total_connected'];

    $feeds = $kdwp->get_feeds($type, $page, $category, $social_filter, $uid);
    //var_dump($category);
    //var_dump($type);
    if (isset($feeds->result)) {
        $feeds = $feeds->result;
    }
    include( plugin_dir_path(__FILE__) . '/includes/feeds-list.php');
    die();
}

add_action('wp_ajax_get_feeds_options', 'get_feeds_options');

function post_publish_action() {

    $kdwp = new Kudobuzzwp();

    $uid = $_POST['uid'];
    $entity_id = $_POST['entity_id'];
    $channel = $_POST['channel'];
    $from_user_name = $_POST['from_user_name'];
    $from_user_img = $_POST['from_user_img'];
    $from_twitter_message = $_POST['from_twitter_message'];
    $created_at = $_POST['created_at'];

    $params = array(
        'uid' => $uid,
        'entity_id' => $entity_id,
        'channel' => $channel,
        'from_user_name' => $from_user_name,
        'from_user_img' => $from_user_img,
        'from_twitter_message' => $from_twitter_message,
        'created_at' => $created_at
    );
    //print_r($params); exit();
    $result = $kdwp->publish_feed($params);
    echo $result;
}

add_action('wp_ajax_post_publish_action', 'post_publish_action');

/*
 * update uid
 */
function post_confirm_action(){
    
    $uid = $_POST['uid'];
    $local_uid = get_option('kudobuzz_uid');
    
    if(isset($local_uid)){
        
        update_option('kudobuzz_uid', $uid);
    }
    else{
        add_option('kudobuzz_uid', $uid);
    }
    
}
add_action('wp_ajax_post_confirm_action', 'post_confirm_action');

/*
 * Recover pass post_login_with_pass_action
 */
function post_recover_pass_action(){
    
    $kdwp = new Kudobuzzwp();
    
    $email = $_POST['email'];
    
    $result = $kdwp->recover_pass($email);
    echo json_encode($result); die();
}
add_action('wp_ajax_post_recover_pass_action', 'post_recover_pass_action');


/*
 * Recover pass 
 */
function post_login_with_pass_action(){
    
    $kdwp = new Kudobuzzwp();
    
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    $result = $kdwp->get_user_with_pass($email, $password);
    echo json_encode($result); die();
}
add_action('wp_ajax_post_login_with_pass_action', 'post_login_with_pass_action');


function create_full_page() {

    $the_page_title = 'Testimonials';
    $the_page_name = 'kudobuzz-full-page-widget';

    // the menu entry...
    delete_option("kudobuzz_page_title");
    add_option("kudobuzz_page_title", $the_page_title, '', 'yes');
    // the slug...
    delete_option("kudobuzz_page_title");
    add_option("kudobuzz_page_name", $the_page_name, '', 'yes');
    // the id...
    delete_option("kudobuzz_plugin_page_id");
    add_option("kudobuzz_plugin_page_id", '0', '', 'yes');

    $the_page = get_page_by_title($the_page_title);

    if (!$the_page) {

        // Create post object
        $_p = array();
        $_p['post_title'] = $the_page_title;
        $_p['post_content'] = "[kudobuzz-fullpage]";
        $_p['post_status'] = 'publish';
        $_p['post_type'] = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status'] = 'closed';
        $_p['post_category'] = array(1); // the default 'Uncatrgorised'
        // Insert the post into the database
        $the_page_id = wp_insert_post($_p);
    } else {

        // the plugin may have been previously active and the page may just be trashed...

        $the_page_id = $the_page->ID;

        //make sure the page is not trashed...
        $the_page->post_status = 'publish';
        $the_page_id = wp_update_post($the_page);
    }

    delete_option('kudobuzz_plugin_page_id');
    add_option('kudobuzz_plugin_page_id', $the_page_id);
}
