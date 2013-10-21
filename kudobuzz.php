<?php

/*
Plugin Name: Kudobuzz
Plugin URI: https://kudobuzz.com
Description: Kudobuzz is a simple widget that displays selected positive social buzz, or “kudos”, on your website. Kudubuzz makes your website more customer-centric while improving your SEO.
Version: 1.2
Author: Kudobuzz
Author URI: https://kudobuzz.com
License: GPL
*/
if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  You are in a wrong place"; 
	exit; 
}
//Plugin Directory Link
define('Kudobuzz_Plugin_DIR', plugin_dir_path(__FILE__));
define('Kudobuzz_Plugin_URL', plugin_dir_url(__FILE__));
add_action('init', 'header_init');
//Adding the Menu Block
add_action( 'admin_menu', 'register_kudobuzz_menu_page' );
add_action('admin_menu', 'register_kudobuzz_submenu_page');
add_action('wp_head', 'add_widget');
add_action('admin_head', 'get_id');
add_action('admin_footer', 'signup_listener');


//Add shortcode 
add_shortcode("kudobuzz", 'set_shortcode');

  
register_activation_hook(__FILE__, 'activate_kudobuzz_plugin');
add_action('admin_init', 'kudobuzz_plugin_redirect');



function kudobuzz_plugin_redirect() {
    if (get_option('kudobuzz_activation_redirect', false)) {
        delete_option('kudobuzz_activation_redirect');
        wp_redirect('admin.php?page=Sign_up');
    }
}


//action hook for plugin activation
register_deactivation_hook(__FILE__, 'deactivate_kudobuzz_plugin');

//Deactivate plugin
function deactivate_kudobuzz_plugin() {
//delete_option('kudobuzz_uid', '');
delete_option('kudobuzz_div');
delete_option ('kudobuzz_login_url');
}

//Activate plugin
function activate_kudobuzz_plugin() {
 add_option('kudobuzz_activation_redirect', true);
 add_option ('kudobuzz_login_url','https://kudobuzz.com/login');
 add_option ('kudobuzz_div', '<div id="kudobuzz_widget"></div>');
 add_option('kudobuzz_uid', '');
}

$script = "<!--Start Kudobuzz --> <script src=\"https://kudobuzz.com/public/javascripts/kudos/widget.js\"></script><script> Kudos.Widget({uid: '".get_option( 'kudobuzz_uid' )."'});</script><!--End Kudobuzz -->"; 

function register_kudobuzz_submenu_page() {
add_submenu_page('Kudobuzz', __('Kudobuzz-Customize','Sign up'), __('Sign up','kudos-signup'), 'manage_options', 'Sign_up', 'kudobuzz_sign_up');
add_submenu_page('Kudobuzz', __('Kudobuzz-Customize','Activate'), __('Activate','kudos-widget'), 'manage_options', 'Activate', 'activate');
}

function set_shortcode($atts) {

    $our_div = "";
    
    $our_div .= get_option( 'kudobuzz_div' );

    return  $our_div;
}



function register_kudobuzz_menu_page(){
    
    add_menu_page(__('kudobuzz_menu','Kudobuzz'), __('Kudobuzz','kudos-menu'), 'manage_options', 'Kudobuzz', 'kudobuzz_menu',plugins_url('/kudobux-testimonial-widget/assets/img/icon.png' ) );
}

function add_widget(){
  
  echo  $GLOBALS['script'];
}

 
    
function kudobuzz_menu(){
  include( plugin_dir_path( __FILE__ ) . 'instructions.php');
}

function kudobuzz_sign_up(){  
    if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo'<div class="wrap">

<div class="icon32" id="icon-options-general"></div>
 <h2>Kudobuzz Testimonial Widget - Sign Up Page</h2> 
    <div id="kudobuzz_widget" style="width:1000px;min-width:800px;margin-top:10px;"> 
   
    <div id="kudobuzz_header" style="width:100%;
	background-color:#d35400;text-align:center;
	-webkit-border-radius: 5px 5px 0px 0px;
    -moz-border-radius: 5px 5px 0px 0px;
    border-radius: 5px 5px 0px 0px;
	padding:20px 0px 5px 0px ;">
    <span style="top:-7px; position:relative;color: #FFFFFF;
    font-size: 1.5em;
    font-weight: bold;
    height: auto;
    line-height: 0.95em;
    margin-bottom: 100px;
    padding-left: 20px;
    width: auto;">Signup Page -> Get Confirmation Code(via email)  -> Activate Account</span>
    </div>
    </div>
</div>';
	
	echo "<iframe src=\"https://kudobuzz.com/wordpress/signup.php\" width=\"1000px\" height=\"500\"></iframe>";
	
    
}

function activate(){
  include( plugin_dir_path( __FILE__ ) . 'activate.php');   
}


/**
 * Adds Foo_Widget widget.
 */
/**
 * Adds kudobuzz_Widget widget.
 */
class kudobuzz_Widget extends WP_Widget {

	/**
	 * Register Kudobuzz widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'kudobuzz_widget', // Base ID
			__('Kudobuzz Testimonials', 'text_domain'), // Name
			array( 'description' => __( 'Kudobuzz Testimonial Widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
                $embed = get_option( 'kudobuzz_div' );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		echo '<html>'.$embed.'</html>';
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class kudobuzz_Widget
// register kudobuzz_Widget widget
function register_kudobuzz_widget() {
    register_widget( 'kudobuzz_Widget' );
}
add_action( 'widgets_init', 'register_kudobuzz_widget' );


?>