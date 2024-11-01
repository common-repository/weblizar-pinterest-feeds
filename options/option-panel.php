<?php
if (!defined('ABSPATH')) exit;
/**
 * Seo Images Optimizer Admin Menu
 */

add_action('admin_menu', 'pffree_admin_menu_pannel');
function pffree_admin_menu_pannel()
{
	$page = add_menu_page(esc_html__('Weblizar Pin Feeds', PFFREE_TEXT_DOMAIN), esc_html__('Weblizar Pin Feeds', PFFREE_TEXT_DOMAIN), 'manage_options', 'pffree-weblizar', 'pffree_option_panal_function', 'dashicons-format-image');
	add_action('admin_print_styles-' . $page, 'pffree_admin_enqueue_script'); // add_action function for adding the js and css files
}
/**
 * Weblizar Admin Menu CSS
 */
// for Adding css and js files of plugin
function pffree_admin_enqueue_script()
{
	// Register the script
	wp_enqueue_script('jquery');
	wp_register_script('pffree-option', plugin_dir_url(__FILE__) . 'js/option-js.js', array('jquery'));
	// Localize the script with new data
	$pffree_translation_array = array(
		'data_reset_confirm' => esc_html__('Do you want restored all your setting!', PFFREE_TEXT_DOMAIN),
		'data_reset_cancelled' => esc_html__('Cancel! Restored All your setting process', PFFREE_TEXT_DOMAIN)
	);
	wp_localize_script('pffree-option', 'pffree_js', $pffree_translation_array);
	// Enqueued script with localized data.
	wp_enqueue_script('pffree-option', array('media-upload'));

	wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css');
	wp_enqueue_style('users_profile_css', plugin_dir_url(__FILE__) . 'css/users_profile.css');
	wp_enqueue_style('weblizar-option-style', plugin_dir_url(__FILE__) . 'css/option-style.css');
	wp_enqueue_script('popper', plugin_dir_url(__FILE__) . 'js/popper.min.js');
	wp_enqueue_script('weblizar-bt-toggle', plugin_dir_url(__FILE__) . 'js/bt-toggle.js');
	wp_enqueue_script('multiselectjs', plugin_dir_url(__FILE__) . 'js/jquery.multiselect.js');
	wp_enqueue_script('user_script', plugin_dir_url(__FILE__) . 'js/user_script.js');
	wp_enqueue_script('bootstrap', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), false, true);

	//For Preview Of shortcode
	wp_enqueue_script('isotope-pkgd', plugin_dir_url(__FILE__) . 'theme/js/isotope.pkgd.js', array('jquery'), 1.1, true);
	wp_enqueue_script('gl_isotope-pkgd', plugin_dir_url(__FILE__) . 'theme/js/gl_isotope.js', array('jquery'), 1.1, true);
	wp_enqueue_script('custom', plugin_dir_url(__FILE__) . 'theme/js/custom.js', array('jquery'), 1.1, true);
	wp_enqueue_script('jquery-shuffle-min', plugin_dir_url(__FILE__) . 'theme/js/jquery.shuffle.min.js', array('jquery'), 1.1, true);
	wp_enqueue_script('script2', plugin_dir_url(__FILE__) . 'theme/js/script.js', array('jquery'), 1.1, true);
	wp_enqueue_style('style_css-main', plugin_dir_url(__FILE__) . 'theme/css/style.css');
	wp_enqueue_style('media', plugin_dir_url(__FILE__) . 'theme/css/media.css');
	wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'css/all.min.css');
}
/**
 * Weblizar Plugin Option Form
 */
function pffree_option_panal_function()
{ ?>
	<div class="msg-overlay">
		<img id="loading-image" src="<?php echo plugin_dir_url(__FILE__) ?>images/loader.gif" alt="Weblizar" height="200" style="margin-top:-10px; margin-right:10px;" alt="Loading..." />
		<div class="success-msg">
			<div class="alert alert-success">
				<strong><?php esc_html_e('Success', PFFREE_TEXT_DOMAIN); ?></strong> <?php esc_html_e('Data Save Successfully', PFFREE_TEXT_DOMAIN); ?>.
			</div>
		</div>
		<div class="reset-msg">
			<div class="alert alert-danger">
				<strong><?php esc_html_e('Success', PFFREE_TEXT_DOMAIN); ?></strong> <?php esc_html_e('Data Reset Successfully', PFFREE_TEXT_DOMAIN); ?>.
			</div>
		</div>
	</div>
	<header>
		<div class="container-fluid top">
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<h2><img src="<?php echo plugin_dir_url(__FILE__) ?>images/logo.png" alt="Weblizar" style="width: 150px;height: 100px;" /> <span style="font-size:24px;font-weight:bold; color:#ffffff!important; top: 6px;position: relative;left: 20px;"><?php esc_html_e('Weblizar Pin Feeds', PFFREE_TEXT_DOMAIN); ?></span></h2>
				</div>
				<div class="col-md-4 col-sm-4 px-3 search1" style="padding: 0px;">
					<a href="https://wordpress.org/support/plugin/pinterest-feed-wordpress" target="_blank"><span class="fas fa-comment-o"></span><?php esc_html_e('Support Forum', PFFREE_TEXT_DOMAIN); ?></a>
					<a href="https://weblizar.com/documentation/plugins/pinterest-feed-wordpress/" target="_blank"><span class="fas fa-pencil-square-o"></span> <?php esc_html_e('View Documentation', PFFREE_TEXT_DOMAIN); ?></a>
					<div class="weblizar-notice-content" style="text-align: center;float: right;">
						<div class="wporg-ratings rating-stars">
							<?php $weblizar_rate_url = 'https://wordpress.org/support/plugin/pinterest-feed-wordpress/reviews/?rate=5#new-post'; ?>
							<strong><?php esc_html_e('Do you like this plugin', PFFREE_TEXT_DOMAIN); ?>?</br>
								<?php esc_html_e('Please take a few seconds to rate it on', PFFREE_TEXT_DOMAIN); ?><?php esc_html_e('WordPress.org!', PFFREE_TEXT_DOMAIN); ?></br></strong>
							<a class="weblizar-rate-it" href="<?php echo esc_url($weblizar_rate_url); ?>"></a>

							<a target="_blank" href="//wordpress.org/support/plugin/pinterest-feed-wordpress/reviews/?rate=1#new-post" data-rating="1" title="Poor"><span class="dashicons dashicons-star-filled" style="color:#ffb900 !important;"></span></a>
							<a target="_blank" href="//wordpress.org/support/plugin/pinterest-feed-wordpress/reviews/?rate=2#new-post" data-rating="2" title="Works"><span class="dashicons dashicons-star-filled" style="color:#ffb900 !important;"></span></a>
							<a target="_blank" href="//wordpress.org/support/plugin/pinterest-feed-wordpress/reviews/?rate=3#new-post" data-rating="3" title="Good"><span class="dashicons dashicons-star-filled" style="color:#ffb900 !important;"></span></a>
							<a target="_blank" href="//wordpress.org/support/plugin/pinterest-feed-wordpress/reviews/?rate=4#new-post" data-rating="4" title="Great"><span class="dashicons dashicons-star-filled" style="color:#ffb900 !important;"></span></a>
							<a target="_blank" href="//wordpress.org/support/plugin/pinterest-feed-wordpress/reviews/?rate=5#new-post" data-rating="5" title="Fantastic!"><span class="dashicons dashicons-star-filled" style="color:#ffb900 !important;"></span></a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</header>
	<div class="container-fluid support p-0">
		<div class=" left-sidebar">
			<div class="col-md-12 menu">
				<!-- tabs left -->
				<div id="options_tabs" class="ui-tabs col-xs-12 tabbable tabs-left">
					<div class=" user-details">
						<div class="profile-pic"></div>
					</div>
					<ul class="options_tabs ui-tabs col-md-12 col-xs-12 nav nav-tabs collapsible collapsible-accordion ui-tabs-nav" role="tablist" id="nav">
						<?php $wl_naf_options = get_option('weblizar_naf_options'); // get option settings from saved database 
						?>
						<li data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e('General Settings', PFFREE_TEXT_DOMAIN); ?>"><a href="#" id="get-users-details" data-toggle="tab"><?php esc_html_e('General Settings', PFFREE_TEXT_DOMAIN); ?></a></li>
						<!-- <li data-toggle="tooltip" data-placement="top" title="<?php //esc_attr_e('Pinterest Users Boards Pins Settings', PFFREE_TEXT_DOMAIN );
																					?>"><a href="#" id="get-board-option" data-toggle="tab"><?php //esc_html_e('How to Use ?', PFFREE_TEXT_DOMAIN );
																																			?></a></li> -->
					</ul>
					<!-- Option Settings form  -->
					<?php require_once('option-settings.php'); ?>
					<a class="back-to-top back-top" href="#" style="display: inline;"><i class="fas fa-angle-up"></i></a>
				</div>
			</div>
		</div>
	</div>
<?php }
// Restore all defaults
if (isset($_POST['restore_all_defaults'])) {
	$wl_pffree_options = weblizar_pffree_default_settings();
	update_option('weblizar_pffree_options', $wl_pffree_options);
}

function add_pffree_shortcode_scripts_style()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('popper', plugin_dir_url(__FILE__) . 'js/popper.min.js');
	wp_enqueue_script('isotope-pkgd', plugin_dir_url(__FILE__) . 'theme/js/isotope.pkgd.js', array('jquery'), 1.1, true);
	wp_enqueue_script('gl_isotope-pkgd', plugin_dir_url(__FILE__) . 'theme/js/gl_isotope.js', array('jquery'), 1.1, true);
	wp_enqueue_script('jquery-shuffle-min', plugin_dir_url(__FILE__) . 'theme/js/jquery.shuffle.min.js', array('jquery'), 1.1, true);
	wp_enqueue_script('script2', plugin_dir_url(__FILE__) . 'theme/js/script.js', array('jquery'), 1.1, true);
	wp_enqueue_script('custom', plugin_dir_url(__FILE__) . 'theme/js/custom.js', array('jquery'), 1.1, true);
	wp_enqueue_script('bootstrap', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), 1.1, true);
	wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css');
	wp_enqueue_style('style_css-main', plugin_dir_url(__FILE__) . 'theme/css/style.css');
	wp_enqueue_style('media', plugin_dir_url(__FILE__) . 'theme/css/media.css');
	wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'css/all.min.css');
	// add_action( 'pffree_dequeue_script', 'pffree_dequeue_script', 1 );
}
add_action('wp_enqueue_scripts', 'add_pffree_shortcode_scripts_style');

function pffree_dequeue_script()
{
	wp_dequeue_script('bootstrap-min-js');
	wp_dequeue_script('bootstrap');
	wp_dequeue_script('bootstrap-js');
	wp_dequeue_script('bootstrap.min');
}
require_once('theme/pin-includes/shortcode.php');
require_once('theme/pin-includes/widget-settings.php');

// Option Data saving
add_action('wp_ajax_pffree_security', 'pffree_security_function');
function pffree_security_function()
{
	//print_r($_POST);
	if (wp_verify_nonce($_POST['security'], 'pffree_security_action')) {
		$wl_pffree_options = weblizar_pffree_get_options();
		if (check_ajax_referer('pffree_security_action', 'security')) {
			if (isset($_POST['weblizar_pffree_settings_save_get-users'])) {
				if ($_POST['weblizar_pffree_settings_save_get-users'] == 1) {
					foreach ($_POST as  $key => $value) {
						$wl_pffree_options[$key] = sanitize_text_field($_POST[$key]);
					}
					$j = 0;
					if (isset($_POST['user_fields_value'])) {
						foreach ($_POST['user_fields_value'] as $user_fields_value) {
							if ($user_fields_value != '') {
								$user_fields[$j] = $user_fields_value;
							}
							$j++;
						}
					}
					if (isset($user_fields)) {
						$wl_pffree_options['user_fields_value'] = $user_fields;
					}
					update_option('weblizar_pffree_options', stripslashes_deep($wl_pffree_options));
				}

				if ($_POST['weblizar_pffree_settings_save_get-users'] == 2) {
					pffree_user_setting();
				}

				if ($_POST['PFFREE_Access_Token']) {
					echo esc_html($wl_pffree_options['PFFREE_Access_Token']);
				} else {
					echo esc_html($wl_pffree_options['PFFREE_Access_Token'] = "111");
				}


				if (isset($_POST['PFFREE_App_Id'])) {
					echo esc_html($wl_pffree_options['PFFREE_App_Id'] = sanitize_text_field($_POST['PFFREE_App_Id']));
				} else {
					echo esc_html($wl_pffree_options['PFFREE_App_Id'] = "111");
				}

				if (isset($_POST['PFFREE_App_Seceret_Key'])) {
					echo esc_html($wl_pffree_options['PFFREE_App_Seceret_Key'] = sanitize_text_field($_POST['PFFREE_App_Seceret_Key']));
				} else {
					echo esc_html($wl_pffree_options['PFFREE_App_Seceret_Key'] = "222");
				}
			}

			if (isset($_POST['weblizar_pffree_settings_save_section_general'])) {
				if ($_POST['weblizar_pffree_settings_save_section_general'] == 1) {
					foreach ($_POST as  $key => $value) {
						$wl_pffree_options[$key] = sanitize_text_field($_POST[$key]);
					}
					if ($_POST['profile_section_onoff']) {
						echo esc_html($wl_pffree_options['profile_section_onoff'] = sanitize_text_field($_POST['profile_section_onoff']));
					} else {
						echo esc_html($wl_pffree_options['profile_section_onoff'] = "off");
					}
					if ($_POST['profile_image_onoff']) {
						echo esc_html($wl_pffree_options['profile_image_onoff'] = sanitize_text_field($_POST['profile_image_onoff']));
					} else {
						echo esc_html($wl_pffree_options['profile_image_onoff'] = "off");
					}
					if ($_POST['user_name_onoff']) {
						echo esc_html($wl_pffree_options['user_name_onoff'] = sanitize_text_field($_POST['user_name_onoff']));
					} else {
						echo esc_html($wl_pffree_options['user_name_onoff'] = "off");
					}
					if ($_POST['user_description_onoff']) {
						echo esc_html($wl_pffree_options['user_description_onoff'] = sanitize_text_field($_POST['user_description_onoff']));
					} else {
						echo esc_html($wl_pffree_options['user_description_onoff'] = "off");
					}
					if ($_POST['user_counts_onoff']) {
						echo esc_html($wl_pffree_options['user_counts_onoff'] = sanitize_text_field($_POST['user_counts_onoff']));
					} else {
						echo esc_html($wl_pffree_options['user_counts_onoff'] = "off");
					}
					if ($_POST['boards_onoff']) {
						echo esc_html($wl_pffree_options['boards_onoff'] = sanitize_text_field($_POST['boards_onoff']));
					} else {
						echo esc_html($wl_pffree_options['boards_onoff'] = "off");
					}
					if ($_POST['pins_onoff']) {
						echo esc_html($wl_pffree_options['pins_onoff'] = sanitize_text_field($_POST['pins_onoff']));
					} else {
						echo esc_html($wl_pffree_options['pins_onoff'] = "off");
					}
					if (isset($_POST['likes_onoff'])) {
						echo esc_html($wl_pffree_options['likes_onoff'] = sanitize_text_field($_POST['likes_onoff']));
					} else {
						echo esc_html($wl_pffree_options['likes_onoff'] = "off");
					}
					if ($_POST['following_onoff']) {
						echo esc_html($wl_pffree_options['following_onoff'] = sanitize_text_field($_POST['following_onoff']));
					} else {
						echo esc_html($wl_pffree_options['following_onoff'] = "off");
					}
					if ($_POST['followers_onoff']) {
						echo esc_html($wl_pffree_options['followers_onoff'] = sanitize_text_field($_POST['followers_onoff']));
					} else {
						echo esc_html($wl_pffree_options['followers_onoff'] = "off");
					}
					if ($_POST['user_follow_onoff']) {
						echo esc_html($wl_pffree_options['user_follow_onoff'] = sanitize_text_field($_POST['user_follow_onoff']));
					} else {
						echo esc_html($wl_pffree_options['user_follow_onoff'] = "off");
					}
					$i = 0;
					if (isset($_POST['pinterest_board_name'])) {
						foreach ($_POST['pinterest_board_name'] as $pinterest_board_name) {
							if ($pinterest_board_name != '') {
								$value_get[$i] = $pinterest_board_name;
							}
							$i++;
						}
					}
					if (isset($value_get)) {
						$wl_pffree_options['pinterest_board_name'] = $value_get;
					}
					if ($_POST['pins_section_onoff']) {
						echo esc_html($wl_pffree_options['pins_section_onoff'] = sanitize_text_field($_POST['pins_section_onoff']));
					} else {
						echo esc_html($wl_pffree_options['pins_section_onoff'] = "off");
					}
					if ($_POST['pins_preview_onoff']) {
						echo esc_html($wl_pffree_options['pins_preview_onoff'] = sanitize_text_field($_POST['pins_preview_onoff']));
					} else {
						echo esc_html($wl_pffree_options['pins_preview_onoff'] = "off");
					}
					update_option('weblizar_pffree_options', stripslashes_deep($wl_pffree_options));
				}

				if ($_POST['weblizar_pffree_settings_save_section_general'] == 2) {
					pffree_general_setting();
				}
			}
		}
	} // end of nonce check
}
?>