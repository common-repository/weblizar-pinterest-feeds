<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// Creating the Pinterest Feed Widget
class pffree_form_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'pffree_form_widget',

// Widget name will appear in UI
esc_html__('Pin Feed Widget', PFFREE_TEXT_DOMAIN),

// Widget description
array( 'description' => esc_html__( 'Widget For Pinterest Feed API', PFFREE_TEXT_DOMAIN ), )
);
// Register admin styles and scripts
add_action( 'admin_print_styles', array( $this, 'pffree_register_admin_styles' ) );
add_action( 'admin_enqueue_scripts', array( $this, 'pffree_register_admin_scripts' ) );
}

// Creating widget front-end
// This is where the action happens

public function pffree_register_admin_styles() {

		wp_enqueue_style( 'weblizar-widget-styles', plugins_url( '/../css/widgetcss.css', __FILE__ ) );
}
// end register_admin_styles


/**
 * Registers and enqueues admin-specific JavaScript.
 */
public function pffree_register_admin_scripts() {

		wp_enqueue_script( 'weblizar-widget-js', plugins_url( '/../js/widgetjs.js', __FILE__ ), array('jquery') );
}
// end register_admin_scripts

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$profile = apply_filters( 'widget_title', $instance['profile'] );
$profile_image = apply_filters( 'widget_title', $instance['profile_image'] );
$user_name = apply_filters( 'widget_title', $instance['user_name'] );
$user_description = apply_filters( 'widget_title', $instance['user_description'] );
$user_counts = apply_filters( 'widget_title', $instance['user_counts'] );
$user_counts_boards = apply_filters( 'widget_title', $instance['user_counts_boards'] );
$user_counts_pins = apply_filters( 'widget_title', $instance['user_counts_pins'] );
/* $user_counts_likes = apply_filters( 'widget_title', $instance['user_counts_likes'] ); */
$user_counts_following = apply_filters( 'widget_title', $instance['user_counts_following'] );
$user_counts_followers = apply_filters( 'widget_title', $instance['user_counts_followers'] );
$user_follow = apply_filters( 'widget_title', $instance['user_follow'] );
$pins = apply_filters( 'widget_title', $instance['pins'] );

$pinterest_api_id = apply_filters( 'widget_title', $instance['pinterest_api_id'] );
// before and after widget arguments are defined by themes
echo wp_kses_post($args['before_widget']);
if ( ! empty( $title ) )
echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
// This is where you run the code and display the output
if ( ! defined( 'ABSPATH' ) ) exit;
	require_once('pinterest_feed_api.php');
	$wl_pffree_options = get_option('weblizar_pffree_options');
	$pinterest_feed_api = new PFFREE_pinterest_feed_api($wl_pffree_options['PFFREE_Access_Token']);
	$profile_result = $pinterest_feed_api->add_pffree_profile_result();
	$board_result = $pinterest_feed_api->add_pffree_board_result();
	$custom_css = '';
	if($wl_pffree_options['pinterest_custom_css']!=''){

		$custom_css .= $wl_pffree_options['pinterest_custom_css']."\r\n";
	}
	wp_add_inline_style('style_css-main', $custom_css);
	echo '<div id="pffree_form_widget_template1" class="container pinterest-sidebar pinterest-main pffree_form_widget_template1 pinterest_feed1">';
	include PFFREE_PLUGIN_URL .'options/theme/pin-sidebar/sidebar-template1.php';
	echo '</div>';


echo wp_kses_post($args['after_widget'] . $title . $args['after_title']);
}

// Widget Backend
public function form( $instance ) {
$wl_pffree_options = weblizar_pffree_get_options();

if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = esc_html__( 'New title', PFFREE_TEXT_DOMAIN );
}
if ( isset( $instance[ 'profile' ] ) ) { $profile = $instance['profile'];}else {$profile = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'profile_image' ] ) ) { $profile_image = $instance['profile_image'];}else {$profile_image = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'user_name' ] ) ) { $user_name = $instance['user_name'];}else {$user_name = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'user_description' ] ) ) { $user_description = $instance['user_description'];}else {$user_description = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'user_counts' ] ) ) { $user_counts = $instance['user_counts'];}else {$user_counts = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'user_counts_boards' ] ) ) { $user_counts_boards = $instance['user_counts_boards'];}else {$user_counts_boards = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'user_counts_pins' ] ) ) { $user_counts_pins = $instance['user_counts_pins'];}else {$user_counts_pins = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
/* if ( isset( $instance[ 'user_counts_likes' ] ) ) { $user_counts_likes = $instance['user_counts_likes'];}else {$user_counts_likes = esc_html__( 'on',PFFREE_TEXT_DOMAIN );} */
if ( isset( $instance[ 'user_counts_following' ] ) ) { $user_counts_following = $instance['user_counts_following'];}else {$user_counts_following = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'user_counts_followers' ] ) ) { $user_counts_followers = $instance['user_counts_followers'];}else {$user_counts_followers = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'user_follow' ] ) ) { $user_follow = $instance['user_follow'];}else {$user_follow = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'pins' ] ) ) { $pins = $instance['pins'];}else {$pins = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
if ( isset( $instance[ 'pinterest_api_id' ] ) ) {
$pinterest_api_id = rand(0,10000000);
}
else {
$pinterest_api_id = rand(0,10000000);
}
// Widget admin form
?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title', PFFREE_TEXT_DOMAIN ); ?></label>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<h4 class="pffree_settings" for="<?php echo esc_attr($this->get_field_id( 'profile_settings' )); ?>"><?php esc_html_e( 'Profile Settings', PFFREE_TEXT_DOMAIN ); ?></h4>
<div class="profile_settings">
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'profile' )); ?>"><?php esc_html_e( 'Profile Section', PFFREE_TEXT_DOMAIN ); ?></label>
<select id="<?php echo esc_attr($this->get_field_id( 'profile' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'profile' )); ?>" class="form-control">
<option value="on" <?php echo selected($profile, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option>
<option value="off" <?php echo selected($profile, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option>
</select>
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>"><?php esc_html_e( 'Image', PFFREE_TEXT_DOMAIN ); ?></label>
<select id="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'profile_image' )); ?>" class="form-control">
<option value="on" <?php echo selected($profile_image, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option>
<option value="off" <?php echo selected($profile_image, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option>
</select>
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'user_name' )); ?>"><?php esc_html_e( 'Name', PFFREE_TEXT_DOMAIN ); ?></label>
<select id="<?php echo esc_attr($this->get_field_id( 'user_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_name' )); ?>" class="form-control">
<option value="on" <?php echo selected($user_name, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option>
<option value="off" <?php echo selected($user_name, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option>
</select>
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'user_description' )); ?>"><?php esc_html_e( 'Description', PFFREE_TEXT_DOMAIN ); ?></label>
<select id="<?php echo esc_attr($this->get_field_id( 'user_description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_description' )); ?>" class="form-control">
<option value="on" <?php echo selected($user_description, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option>
<option value="off" <?php echo selected($user_description, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option>
</select>
</p>
<h4 class="pffree_settings" for="<?php echo esc_attr($this->get_field_id( 'profile_stat_settings' )); ?>"><?php esc_html_e( 'Profile Stat Settings', PFFREE_TEXT_DOMAIN ); ?></h4>
<div class="profile_stat_settings">
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'user_counts' )); ?>"><?php esc_html_e( 'Profile Stat', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

<p><label for="<?php echo esc_attr($this->get_field_id( 'user_counts_pins' )); ?>"><?php esc_html_e( 'Pins button', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts_pins' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts_pins' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts_pins, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts_pins, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

<p><label for="<?php echo esc_attr($this->get_field_id( 'user_counts_boards' )); ?>"><?php esc_html_e( 'Board button', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts_boards' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts_boards' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts_boards, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts_boards, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

<p><label for="<?php echo esc_attr($this->get_field_id( 'user_follow' )); ?>"><?php esc_html_e( 'Follow Button', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_follow' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_follow' )); ?>" class="form-control"><option value="on" <?php echo selected($user_follow, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_follow, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

<p><label for="<?php echo esc_attr($this->get_field_id( 'user_counts_following' )); ?>"><?php esc_html_e( 'Following', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts_following' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts_following' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts_following, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts_following, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

<p><label for="<?php echo esc_attr($this->get_field_id( 'user_counts_followers' )); ?>"><?php esc_html_e( 'Followers', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts_followers' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts_followers' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts_followers, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts_followers, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

</div>
</div>
<h4 class="pffree_settings" for="<?php echo esc_attr($this->get_field_id( 'pins_settings' )); ?>"><?php esc_html_e( 'Pins Settings', PFFREE_TEXT_DOMAIN ); ?></h4>
<div class="pins_settings">
<p><label for="<?php echo esc_attr($this->get_field_id( 'pins' )); ?>"><?php esc_html_e( 'Pins Section', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'pins' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pins' )); ?>" class="form-control"><option value="on" <?php echo selected($pins, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($pins, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select>
<input class="" id="<?php echo esc_attr($this->get_field_id( 'pinterest_api_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest_api_id' )); ?>" type="hidden" value="<?php echo esc_attr($pinterest_api_id); ?>" />
</p>
</div>
<?php }

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['pinterest_api_id'] = ( ! empty( $new_instance['pinterest_api_id'] ) ) ? strip_tags( $new_instance['pinterest_api_id'] ) : '';
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['profile'] = ( ! empty( $new_instance['profile'] ) ) ? strip_tags( $new_instance['profile'] ) : '';
$instance['profile_image'] = ( ! empty( $new_instance['profile_image'] ) ) ? strip_tags( $new_instance['profile_image'] ) : '';
$instance['user_name'] = ( ! empty( $new_instance['user_name'] ) ) ? strip_tags( $new_instance['user_name'] ) : '';
$instance['user_description'] = ( ! empty( $new_instance['user_description'] ) ) ? strip_tags( $new_instance['user_description'] ) : '';
$instance['user_counts'] = ( ! empty( $new_instance['user_counts'] ) ) ? strip_tags( $new_instance['user_counts'] ) : '';
$instance['user_counts_boards'] = ( ! empty( $new_instance['user_counts_boards'] ) ) ? strip_tags( $new_instance['user_counts_boards'] ) : '';
$instance['user_counts_pins'] = ( ! empty( $new_instance['user_counts_pins'] ) ) ? strip_tags( $new_instance['user_counts_pins'] ) : '';
/* $instance['user_counts_likes'] = ( ! empty( $new_instance['user_counts_likes'] ) ) ? strip_tags( $new_instance['user_counts_likes'] ) : ''; */
$instance['user_counts_following'] = ( ! empty( $new_instance['user_counts_following'] ) ) ? strip_tags( $new_instance['user_counts_following'] ) : '';
$instance['user_counts_followers'] = ( ! empty( $new_instance['user_counts_followers'] ) ) ? strip_tags( $new_instance['user_counts_followers'] ) : '';
$instance['user_follow'] = ( ! empty( $new_instance['user_follow'] ) ) ? strip_tags( $new_instance['user_follow'] ) : '';
$instance['pins'] = ( ! empty( $new_instance['pins'] ) ) ? strip_tags( $new_instance['pins'] ) : '';
return $instance;
}
} // Class pffree_form_widget ends here

// Register and load the widget
function pffree_form_load_widget() {

	register_widget( 'pffree_form_widget');

}
add_action( 'widgets_init', 'pffree_form_load_widget' );

// Creating the Pinterest Profile Widget
class pffree_profile extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'pffree_profile',

// Widget name will appear in UI
esc_html__('Pin Profile Widget', PFFREE_TEXT_DOMAIN),

// Widget description
array( 'description' => esc_html__( 'Widget For Profile of Pinterest Feed API', PFFREE_TEXT_DOMAIN ), )
);
// Register admin styles and scripts
add_action( 'admin_print_styles', array( $this, 'pffree_register_admin_styles' ) );
add_action( 'admin_enqueue_scripts', array( $this, 'pffree_register_admin_scripts' ) );
}

// Creating widget front-end
// This is where the action happens

public function pffree_register_admin_styles() {

		wp_enqueue_style( 'weblizar-widget-styles', plugins_url( 'css/widgetcss.css', __FILE__ ) );
}
// end register_admin_styles


/**
 * Registers and enqueues admin-specific JavaScript.
 */
public function pffree_register_admin_scripts() {

		wp_enqueue_script( 'weblizar-widget-js', plugins_url( 'js/widgetjs.js', __FILE__ ), array('jquery') );
}
// end register_admin_scripts

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$user_follow = apply_filters( 'widget_title', $instance['user_follow'] );
$profile_image = apply_filters( 'widget_title', $instance['profile_image'] );
$user_name = apply_filters( 'widget_title', $instance['user_name'] );
$user_description = apply_filters( 'widget_title', $instance['user_description'] );
$user_counts = apply_filters( 'widget_title', $instance['user_counts'] );
$user_counts_boards = apply_filters( 'widget_title', $instance['user_counts_boards'] );
$user_counts_pins = apply_filters( 'widget_title', $instance['user_counts_pins'] );
/* $user_counts_likes = apply_filters( 'widget_title', $instance['user_counts_likes'] ); */
$user_counts_following = apply_filters( 'widget_title', $instance['user_counts_following'] );
$user_counts_followers = apply_filters( 'widget_title', $instance['user_counts_followers'] );

// before and after widget arguments are defined by themes
echo wp_kses_post($args['before_widget']);
if ( ! empty( $title ) )
echo wp_kses_post($args['before_title'] . $title . $args['after_title']);

// This is where you run the code and display the output
if ( ! defined( 'ABSPATH' ) ) exit;
	require_once('pinterest_feed_api.php');
	$wl_pffree_options = get_option('weblizar_pffree_options');
	$pinterest_feed_api = new PFFREE_pinterest_feed_api($wl_pffree_options['PFFREE_Access_Token']);
	$profile_result = $pinterest_feed_api->add_pffree_profile_result();
	$board_result = $pinterest_feed_api->add_pffree_board_result();
	//$slected_template = $wl_pffree_options['PFFREE_template'];
	echo '<div id="pffree_form_widget_template1" class="container pinterest-sidebar pinterest-main pffree_form_widget_template1 pinterest_feed1">';
	include PFFREE_PLUGIN_URL .'options/theme/pin-sidebar/template1/profile/profile.php';
	echo '</div>';

echo wp_kses_post($args['after_widget']);
}

// Widget Backend
public function form( $instance ) {
	$wl_pffree_options = weblizar_pffree_get_options();

	if ( isset( $instance[ 'title' ] ) )
		{ $title = $instance[ 'title' ]; }	else {	$title = esc_html__( 'New title', PFFREE_TEXT_DOMAIN );	}
	if ( isset( $instance[ 'profile_image' ] ) )
		{ $profile_image = $instance['profile_image']; } else { $profile_image = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
	if ( isset( $instance[ 'user_name' ] ) )
		{ $user_name = $instance['user_name'];}else { $user_name = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
	if ( isset( $instance[ 'user_description' ] ) )
		{ $user_description = $instance['user_description']; } else { $user_description = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
	if ( isset( $instance[ 'user_counts' ] ) )
		{ $user_counts = $instance['user_counts']; } else { $user_counts = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
	if ( isset( $instance[ 'user_counts_boards' ] ) )
		{ $user_counts_boards = $instance['user_counts_boards'];}else {$user_counts_boards = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
	if ( isset( $instance[ 'user_counts_pins' ] ) )
		{ $user_counts_pins = $instance['user_counts_pins'];}else {$user_counts_pins = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
	if ( isset( $instance[ 'user_counts_following' ] ) )
		{ $user_counts_following = $instance['user_counts_following']; } else { $user_counts_following = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
	if ( isset( $instance[ 'user_counts_followers' ] ) )
		{ $user_counts_followers = $instance['user_counts_followers'];}else {$user_counts_followers = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
	if ( isset( $instance[ 'user_follow' ] ) )
		{ $user_follow = $instance['user_follow']; } else { $user_follow = esc_html__( 'on',PFFREE_TEXT_DOMAIN );}
	if ( isset( $instance[ 'pinterest_api_id' ] ) )
		{ $pinterest_api_id = rand(0,10000000);	}	else {		$pinterest_api_id = rand(0,10000000);	}
	// Widget admin form
	?>
	<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title', PFFREE_TEXT_DOMAIN ); ?></label>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>

	<h4 class="pffree_settings" for="<?php echo esc_attr($this->get_field_id( 'profile_settings' )); ?>"><?php esc_html_e( 'Profile Settings', PFFREE_TEXT_DOMAIN ); ?></h4>
	<div class="profile_settings">
	<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>"><?php esc_html_e( 'Image', PFFREE_TEXT_DOMAIN ); ?></label>
	<select id="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'profile_image' )); ?>" class="form-control">
	<option value="on" <?php echo selected($profile_image, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option>
	<option value="off" <?php echo selected($profile_image, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option>
	</select>
	</p>

	<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'user_name' )); ?>"><?php esc_html_e( 'Name', PFFREE_TEXT_DOMAIN ); ?></label>
	<select id="<?php echo esc_attr($this->get_field_id( 'user_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_name' )); ?>" class="form-control">
	<option value="on" <?php echo selected($user_name, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option>
	<option value="off" <?php echo selected($user_name, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option>
	</select>
	</p>

	<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'user_description' )); ?>"><?php esc_html_e( 'Description', PFFREE_TEXT_DOMAIN ); ?></label>
	<select id="<?php echo esc_attr($this->get_field_id( 'user_description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_description' )); ?>" class="form-control">
	<option value="on" <?php echo selected($user_description, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option>
	<option value="off" <?php echo selected($user_description, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option>
	</select>
	</p>
	<h4 class="pffree_settings" for="<?php echo esc_attr($this->get_field_id( 'profile_stat_settings' )); ?>"><?php esc_html_e( 'Profile Stat Settings', PFFREE_TEXT_DOMAIN ); ?></h4>
	<div class="profile_stat_settings">
	<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'user_counts' )); ?>"><?php esc_html_e( 'Profile Stat', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

	<p><label for="<?php echo esc_attr($this->get_field_id( 'user_counts_pins' )); ?>"><?php esc_html_e( 'Pins button', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts_pins' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts_pins' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts_pins, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts_pins, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

	<p><label for="<?php echo esc_attr($this->get_field_id( 'user_counts_boards' )); ?>"><?php esc_html_e( 'Board button', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts_boards' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts_boards' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts_boards, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts_boards, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

	<p><label for="<?php echo esc_attr($this->get_field_id( 'user_follow' )); ?>"><?php esc_html_e( 'Follow Button', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_follow' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_follow' )); ?>" class="form-control"><option value="on" <?php echo selected($user_follow, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_follow, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>


	<p><label for="<?php echo esc_attr($this->get_field_id( 'user_counts_following' )); ?>"><?php esc_html_e( 'Following', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts_following' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts_following' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts_following, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts_following, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select></p>

	<p><label for="<?php echo esc_attr($this->get_field_id( 'user_counts_followers' )); ?>"><?php esc_html_e( 'Followers', PFFREE_TEXT_DOMAIN ); ?></label><select id="<?php echo esc_attr($this->get_field_id( 'user_counts_followers' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_counts_followers' )); ?>" class="form-control"><option value="on" <?php echo selected($user_counts_followers, 'on' ); ?> ><?php esc_html_e('ON',PFFREE_TEXT_DOMAIN);?></option><option value="off" <?php echo selected($user_counts_followers, 'off' ); ?> ><?php esc_html_e('OFF',PFFREE_TEXT_DOMAIN);?></option></select>
	<input class="" id="<?php echo esc_attr($this->get_field_id( 'pinterest_api_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest_api_id' )); ?>" type="hidden" value="<?php echo esc_attr($pinterest_api_id); ?>" />
	</p>
	</div>
	</div>
<?php }

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['pinterest_api_id'] = ( ! empty( $new_instance['pinterest_api_id'] ) ) ? strip_tags( $new_instance['pinterest_api_id'] ) : '';
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	$instance['profile_image'] = ( ! empty( $new_instance['profile_image'] ) ) ? strip_tags( $new_instance['profile_image'] ) : '';
	$instance['user_name'] = ( ! empty( $new_instance['user_name'] ) ) ? strip_tags( $new_instance['user_name'] ) : '';
	$instance['user_description'] = ( ! empty( $new_instance['user_description'] ) ) ? strip_tags( $new_instance['user_description'] ) : '';
	$instance['user_counts'] = ( ! empty( $new_instance['user_counts'] ) ) ? strip_tags( $new_instance['user_counts'] ) : '';
	$instance['user_counts_boards'] = ( ! empty( $new_instance['user_counts_boards'] ) ) ? strip_tags( $new_instance['user_counts_boards'] ) : '';
	$instance['user_counts_pins'] = ( ! empty( $new_instance['user_counts_pins'] ) ) ? strip_tags( $new_instance['user_counts_pins'] ) : '';
	/* $instance['user_counts_likes'] = ( ! empty( $new_instance['user_counts_likes'] ) ) ? strip_tags( $new_instance['user_counts_likes'] ) : ''; */
	$instance['user_counts_following'] = ( ! empty( $new_instance['user_counts_following'] ) ) ? strip_tags( $new_instance['user_counts_following'] ) : '';
	$instance['user_counts_followers'] = ( ! empty( $new_instance['user_counts_followers'] ) ) ? strip_tags( $new_instance['user_counts_followers'] ) : '';
	$instance['user_follow'] = ( ! empty( $new_instance['user_follow'] ) ) ? strip_tags( $new_instance['user_follow'] ) : '';
	return $instance;
	}
} // Class pffree_form_widget ends here

// Register and load the widget
function pffree_profile_widget() {
	register_widget( 'pffree_profile');
}
add_action( 'widgets_init', 'pffree_profile_widget' ); ?>
