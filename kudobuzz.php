<?php
/*
  Plugin Name: Kudobuzz
  Plugin URI: https://kudobuzz.com
  Description: Kudobuzz is a simple widget that displays selected positive social buzz, or “kudos”, on your website. Collect reviews from your visits. Kudubuzz makes your website more customer-centric while improving your SEO.
  Version: 1.2.4
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


/*
 * When user activate the plugin
 */
register_activation_hook(__FILE__, 'activate_kudobuzz_plugin');
add_action('admin_init', 'kudobuzz_plugin_redirect');

/*
 * 
 */

function kudobuzz_plugin_redirect() {
    if (get_option('kudobuzz_activation_redirect', false)) {
        delete_option('kudobuzz_activation_redirect');
        wp_redirect('admin.php?page=Kudobuzz');
    }
}

/*
 * When user deactivate the plugin
 */
register_deactivation_hook(__FILE__, 'deactivate_kudobuzz_plugin');

/*
 * Trigger function when user deactivate plugin
 */

function deactivate_kudobuzz_plugin() {
    delete_option('kudobuzz_uid');
    delete_option('kudobuzz_div');
    delete_option('kudobuzz_login_url');

    delete_option('kudobuzz_fullpage_widget');
    delete_option('kudobuzz_slider_widget');
    delete_option('kudobuzz_contact_widget');
    delete_option('slider_widget_added');
    delete_option('full_page_widget_added');
}

/**
 * Set code review
 */
add_shortcode("kudobuzz_review", 'set_review_shortcode');

function set_review_shortcode($atts) {

    $kudobuzz_review_tag = "";

    $kudobuzz_review_tag .= get_option('kudobuzz_contact_widget');

    return $kudobuzz_review_tag;
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

/*
 * Trigger function when user activate plugin
 */

function activate_kudobuzz_plugin() {
    add_option('kudobuzz_fullpage_widget', '<div id="kudobuzz-fullpage-widget"></div>');
    add_option('kudobuzz_slider_widget', '<div id="kudobuzz-slider-widget"></div>');
    add_option('kudobuzz_contact_widget', '<div id="kudobuzz-contact-widget"></div>');

    add_option('kudobuzz_login_url', 'https://kudobuzz.com/login');
    add_option('kudobuzz_activation_redirect', true);
    add_option('kudobuzz_uid', '');
    add_option('slider_widget_added', 0);
    add_option('full_page_widget_added', 0);
}

$kd_uid = get_option('kudobuzz_uid');


$site_url = site_url();
$admin_email = get_settings("admin_email");


$user_details_url = MAIN_HOST . 'user/get_user?email=' . $admin_email.'&include_entities=1';
 
$user_details = json_decode(file_get_contents($user_details_url));

if (count($user_details) > 0) {

    $user_id = $user_details->user_id;
    $account_id = $user_details->account_id;
    $email = $user_details->email;
    $account_name = $user_details->account_name;
    $widget_type_id = $user_details->widget_type_id;

    //Get uid
    $url_uid = MAIN_HOST . 'user/get_uid?user_id=' . $user_id . '&account_id=' . $account_id;

    $uid = json_decode(file_get_contents($url_uid));
    
    update_option('kudobuzz_uid', $uid);

    $script = "<!--Start Kudobuzz Here --> <script src='" . MAIN_HOST . "public/javascripts/kudos/widget.js'></script><script> Kudos.Widget({uid: '" . get_option('kudobuzz_uid') . "'});</script><!--End Kudobuzz Here -->";
    
    //Get embedable widgets
    $slider_widget_added = get_option('slider_widget_added');
    $full_page_widget_added = get_option('full_page_widget_added');
}

function add_widget() {

    echo $GLOBALS['script'];
}

add_action('wp_head', 'add_widget');

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

//Now let us render the tabs
function render_tabs() {
    
}

/*
 * Set menu
 */

function register_kudobuzz_menu_page() {

    add_menu_page(__('kudobuzz_menu', 'Kudobuzz'), __('Kudobuzz', 'kudos-menu'), 'manage_options', 'Kudobuzz', 'configuration', plugins_url('/kudobux-testimonial-widget/assets/img/kudo_head.png'));
}

function configuration() {
    $user_id = $GLOBALS['user_id'];

    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>
    <div class="wrap">        
        <div class="icon32" id="icon-options-general"></div>
        <h2>Kudobuzz Testimonial Widget - Configuration Page</h2> 
    </div>

<div class="alert alert-info hide<?php echo isset($user_id) && !empty($user_id)?'':''?>" style="font-size: 12px; width: 50%">
    <p style="text-transform: uppercase; font-size: 11px">Welcome back!</p>
    <p>
        You may login to dashboard and add more kudos to your basket.
    </p>
    <p>
        <a href="<?PHP echo MAIN_HOST?>login" target="_blank" class="btn btn-sm btn-default">Click to login</a>
    </p>
    
</div>

    <!-- Start tabs here -->

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab">
        <li id="form-li" class="active"<?php echo (isset($user_id) && $user_id != NULL) ? '' : '' ?> <?php echo !(isset($user_id)) ? 'class="active"' : '' ?>><a href="#home" <?php echo (isset($user_id) && !empty($user_id)) ? '' : '' ?> data-toggle="tab">Create an Account</a></li>
        <li id="widgets-li" <?php echo (isset($user_id) && $user_id != NULL) ? '' : '' ?>><a href="#profile" <?php echo (isset($user_id) && !empty($user_id)) ? 'data-toggle="tab"' : '' ?>>Choose a Widget</a></li>
        <li id="instructions-li" ><a href="#messages" <?php echo (isset($user_id) && $user_id != NULL) ? 'data-toggle="tab"' : '' ?>>Installation Instruction</a></li>
        <li id="custom-msg-li"><a href="#cs-msg" <?php echo (isset($user_id) && $user_id != NULL) ? 'data-toggle="tab"' : '' ?>>Add Testimonials</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="home">

            <!-- New user form -->
            <div class="content-div">
                <?php require_once plugin_dir_path(__FILE__) . 'includes/new-user-form.php' ?>
            </div>
        </div>
        <div class="tab-pane <?php echo (isset($user_id) && !empty($user_id)) ? ' ' : '' ?>" id="profile">

            <!-- Choose a widget type -->
            <div class="long-content-div">
                <?php require_once plugin_dir_path(__FILE__) . 'includes/widget-types.php' ?>
            </div>

        </div>
        <div class="tab-pane" id="messages">

            <!-- Choose a widget type -->
            <div class="content-div">
                <?php require_once plugin_dir_path(__FILE__) . 'includes/installation-instruction.php' ?>
            </div>

        </div>
        
        <div class="tab-pane" id="cs-msg">
        	<!-- Add a custom feed -->
        	<div class="content-div">
        		<?php require_once plugin_dir_path(__FILE__) . 'includes/cs-feed-form.php'?>
        	</div>
        </div>
    </div>
    <?php
}
