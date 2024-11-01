<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
$pffree_security_action_nonce = wp_create_nonce( "pffree_security_action" ); require_once('pinterest-api-settings.php'); ?>
<script type="text/javascript">
/*Admin options pannal data value*/
function weblizar_pffree_option_data_save(name) {
	var weblizar_settings_save= "#weblizar_pffree_settings_save_"+name;
	var weblizar_theme_options = "#weblizar_pffree_"+name;
	var weblizar_settings_save_success = ".success-msg";
	var weblizar_loding = ".msg-overlay";
	var pffree_action = "pffree_security";
	jQuery(weblizar_loding).show();	
	jQuery(weblizar_settings_save).val("1");        
	jQuery.ajax({
		url: ajaxurl,			
		type:'post',
		data : jQuery(weblizar_theme_options).serialize() + '&action=' + pffree_action + '&security=<?php echo esc_attr($pffree_security_action_nonce); ?>',
		success : function(data) { 
			jQuery(weblizar_loding+' #loading-image').hide();
			jQuery(weblizar_settings_save_success).fadeIn();
			jQuery(weblizar_settings_save_success).fadeOut(1000);
			jQuery(weblizar_loding).fadeOut(2000);					
			window.location = '?page=pffree-weblizar';
		}
	});
}
	
/*Admin options value reset */
function weblizar_pffree_option_data_reset(name) {
	var r=confirm(pffree_js.data_reset_confirm)
	if (r==true){
		var weblizar_settings_save= "#weblizar_pffree_settings_save_"+name;
		var weblizar_theme_options = "#weblizar_pffree_"+name;
		var weblizar_loding = ".msg-overlay";
		var weblizar_settings_save_reset = ".reset-msg";
		var pffree_action = "pffree_security";
		jQuery(weblizar_loding).show();
		jQuery(weblizar_settings_save).val("2");
		jQuery.ajax({
			url: ajaxurl,
			type:'post',
			data : jQuery(weblizar_theme_options).serialize() + '&action=' + pffree_action + '&security=<?php echo esc_attr($pffree_security_action_nonce); ?>',
			success : function(data){
				jQuery(weblizar_loding+' #loading-image').hide();
				jQuery(weblizar_settings_save_reset).fadeIn();
				jQuery(weblizar_settings_save_reset).fadeOut(1000);
				jQuery(weblizar_loding).fadeOut(2000);
				window.location = '?page=pffree-weblizar';
			}
		});			
	} else  {
		alert(pffree_js.data_reset_cancelled);  
	}
}

jQuery(document).ready(function ($) {
	function getQueryString(Param) {
		return decodeURI(
		(RegExp('[#|&]' + Param + '=' + '(.+?)(&|$)').exec(location.hash) || [, null])[1]
		);
	}

	if (window.location.hash) {
		var hash_part = window.location.hash;
		var access_token = getQueryString('access_token');
		jQuery('#PFFREE_Access_Token').val(access_token);
	}
});
</script>
<style>
.col-md-10.option-no-pad {
    margin-top: -10px;
}
</style>
<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
$wl_pffree_options = weblizar_pffree_get_options();?>
<div class="col-xs-12 col-md-12 tab-content" id="spa_general"> <!-- plugin dashboard Main class div setting -->
	<div class="tab-pane col-md-12 block ui-tabs-panel active" id="get-users-details"> <!-- plugin template selection setting -->	
		<div class="row col-md-12">
		<div class="col-md-9 option">		
			<div class="tab-content">             
				<form method="post" id="weblizar_pffree_get-users">					
					<div class="col-md-12 form-group">	
						<h1 class="main_heading"><?php esc_html_e('Access Token', PFFREE_TEXT_DOMAIN );?></h1>
						<p></br></p>
						<div class="col-md-12 option-no-pad">
							<div class="row m-2">
								<div class="col-md-6 option-no-pad ">
									<p class="description">									
										<a class="btn link_btn" href="https://api.pinterest.com/oauth/?response_type=token&redirect_uri=https://www.slickremix.com/pinterest-token-plugin/&client_id=4852080225414031681&scope=read_public&state=<?php echo urlencode(PINTEREST_REDIRECT_URI); ?>"><?php esc_html_e('Get Your Pinterest Access Token', PFFREE_TEXT_DOMAIN)?></a>
										</p><br>
									<p class="description">
										<a class="btn link_btn" target="_blank" href="<?php echo 'https://weblizar.com/blog/generate-access-token-for-pinterest-feed-pro/';?>"><?php esc_html_e('Get Your Pinterest Access Token Using Postman',PFFREE_TEXT_DOMAIN)?></a>
									</p>
								</div>             
								<div class="col-md-6 option-no-pad">
									<div class="row">
										<div class="col-md-4 option-no-pad">
											<label><?php esc_html_e('Access Token', PFFREE_TEXT_DOMAIN)?></label>
										</div>  								
										<div class="col-md-8 option-no-pad">
											<input class="form-control" type="text" id="PFFREE_Access_Token" name="PFFREE_Access_Token" value="<?php if(isset($wl_pffree_options['PFFREE_Access_Token'])) { echo esc_attr($wl_pffree_options['PFFREE_Access_Token']);}?>">
										 </div> 							
									</div>
				
									<?php if(isset($wl_pffree_options['pinterest_user_id'])){
										if($wl_pffree_options['pinterest_user_id'] !=''){ ?>
									<div class="row">
										<div class="col-md-4 option-no-pad">
											<label><?php esc_html_e('User ID',PFFREE_TEXT_DOMAIN)?></label>
										</div>
										<div class="col-md-8 option-no-pad">
											<input class="form-control" type="text" id="pinterest_user_id" name="pinterest_user_id" value="<?php if(isset($wl_pffree_options['pinterest_user_id'])) {echo esc_attr($wl_pffree_options['pinterest_user_id']);} ?>" readonly>
										</div>
									</div>
									<?php } } ?>
									<div class="row">
										<div class="col-md-12 option-no-pad d-flex justify-content-end mt-2"><br>
											<input type="hidden" value="1" id="weblizar_pffree_settings_save_get-users" name="weblizar_pffree_settings_save_get-users" />
											<input class="button mr-2 pull-right" type="button" name="reset" value="<?php esc_attr_e('Restore Defaults', PFFREE_TEXT_DOMAIN );?>" onclick="weblizar_pffree_option_data_reset('get-users');">
											<input class="button button-primary wl_pint_space pull-right" type="button" value="<?php esc_attr_e('Save Options', PFFREE_TEXT_DOMAIN );?>" onclick="weblizar_pffree_option_data_save('get-users')" >
										</div>
									</div>
								</div>
							</div>
						</div>
						<span class="pint_msg"><b><?php esc_html_e('Note', PFFREE_TEXT_DOMAIN );?> :</b> <?php esc_html_e('Show Pinterest Pins On Page', PFFREE_TEXT_DOMAIN );?>/<?php esc_html_e('Post', PFFREE_TEXT_DOMAIN );?>  - <?php esc_html_e('Please copy the pinterest shortcode', PFFREE_TEXT_DOMAIN );?>  <span style="color:#ff0000;"> <b>[pinterest_feed]</b> </span> <?php esc_html_e('and paste it to on the Page/Post', PFFREE_TEXT_DOMAIN );?></span>
					</div>	
				</form>
				<form method="post" id="weblizar_pffree_section_general">
					<div class="col-md-12 form-group">
						<h1 class="main_heading"><?php esc_html_e('Profile & Pin Settings', PFFREE_TEXT_DOMAIN );?></h1>		
						<div class="no-pad col-md-12">
							<div class="row">
								<div class="col-md-6 no-pad">
									<div class="col-md-12 no-pad">	
										<h3 class="sub_heading"><?php esc_html_e('User Profile Settings', PFFREE_TEXT_DOMAIN );?></h3>
										<div class="no-pad col-md-12">
											<div class="col-md-12 row div-margin">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label><?php esc_html_e('Profile Template ', PFFREE_TEXT_DOMAIN );?></label>
													<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Profile Template Show/hide On/OFF', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
												</div>	
												<div class="col-md-6 col-sm-6 col-xs-6">
													<input data-toggle="toggle" data-offstyle="off" type="checkbox" <?php if($wl_pffree_options['profile_section_onoff']=='on') echo "checked='unchecked'"; ?> id="profile_section_onoff" name="profile_section_onoff">
												</div>							
											</div>
											<div class="profile_template-options <?php if($wl_pffree_options['profile_section_onoff']=='on') echo "active"; ?>" id="profile-template">
											<div class="col-md-12 row div-margin">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label><?php esc_html_e('Image', PFFREE_TEXT_DOMAIN );?></label>
													<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Image On/OFF', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
												</div>	
												<div class="col-md-6 col-sm-6 col-xs-6">
													<input type="checkbox" <?php if($wl_pffree_options['profile_image_onoff']=='on') echo "checked='unchecked'"; ?> id="profile_image_onoff" name="profile_image_onoff" >
												</div>
											</div>
											<div class="col-md-12 row div-margin">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label><?php esc_html_e('Name', PFFREE_TEXT_DOMAIN );?></label>
													<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Name Show/hide On/OFF', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
												</div>	
												<div class="col-md-6 col-sm-6 col-xs-6">
													<input type="checkbox" <?php if($wl_pffree_options['user_name_onoff']=='on') echo "checked='unchecked'"; ?> id="user_name_onoff" name="user_name_onoff">
												</div>
											</div>
											<div class="col-md-12 row div-margin">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label><?php esc_html_e('Description', PFFREE_TEXT_DOMAIN );?></label>
													<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Description Show/hide On/OFF', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
												</div>	
												<div class="col-md-6 col-sm-6 col-xs-6">
													<input type="checkbox" <?php if($wl_pffree_options['user_description_onoff']=='on') echo "checked='unchecked'"; ?> id="user_description_onoff" name="user_description_onoff">
												</div>
											</div>
											<div class="col-md-12 row div-margin">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label><?php esc_html_e('Counts', PFFREE_TEXT_DOMAIN );?></label>
													<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Counts Show/hide On/OFF', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
												</div>	
												<div class="col-md-6 col-sm-6 col-xs-6">
													<input data-toggle="toggle" data-offstyle="off" type="checkbox" <?php if($wl_pffree_options['user_counts_onoff']=='on') echo "checked='unchecked'"; ?> id="user_counts_onoff" name="user_counts_onoff">
												</div>	
											</div>
											<div class="col-md-12 no-pad user_counts-options <?php if($wl_pffree_options['user_counts_onoff']=='on') echo "active"; ?>" id="user_counts-template">		
												<div class="col-md-12 row div-margin">
													<div class="col-md-6 col-sm-6 col-xs-6">
														<label><?php esc_html_e('Show/Hide Values', PFFREE_TEXT_DOMAIN );?></label>
														<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Counts Values Show/hide by selection', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
													</div>	
													<div class="col-md-6 col-sm-6 col-xs-6">
														<input data-offstyle="off" type="checkbox" <?php if($wl_pffree_options['boards_onoff']=='on') echo "checked='unchecked'"; ?> id="boards_onoff" name="boards_onoff">
														<label><?php esc_html_e('Boards', PFFREE_TEXT_DOMAIN );?></label></br>
														<input data-offstyle="off" type="checkbox" <?php if($wl_pffree_options['pins_onoff']=='on') echo "checked='unchecked'"; ?> id="pins_onoff" name="pins_onoff">
														<label><?php esc_html_e('Pins', PFFREE_TEXT_DOMAIN );?></label></br>
														<!--<input data-offstyle="off" type="checkbox" <?php //if($wl_pffree_options['likes_onoff']=='on') echo "checked='unchecked'"; ?> id="likes_onoff" name="likes_onoff">
														<label><?php //_e('Likes', PFFREE_TEXT_DOMAIN );?></label></br>-->
														<input data-offstyle="off" type="checkbox" <?php if($wl_pffree_options['following_onoff']=='on') echo "checked='unchecked'"; ?> id="following_onoff" name="following_onoff">
														<label><?php esc_html_e('Following', PFFREE_TEXT_DOMAIN );?></label></br>
														<input data-offstyle="off" type="checkbox" <?php if($wl_pffree_options['followers_onoff']=='on') echo "checked='unchecked'"; ?> id="followers_onoff" name="followers_onoff">
														<label><?php esc_html_e('Followers', PFFREE_TEXT_DOMAIN );?></label>
													</div>								
												</div>								
											</div>								
											<div class="col-md-12 row div-margin">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label><?php esc_html_e('Follow Button', PFFREE_TEXT_DOMAIN );?></label>
													<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Follow Button Show/hide On/OFF', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
												</div>	
												<div class="col-md-6 col-sm-6 col-xs-6">
													<input type="checkbox" <?php if($wl_pffree_options['user_follow_onoff']=='on') echo "checked='unchecked'"; ?> id="user_follow_onoff" name="user_follow_onoff">
												</div>							
											</div>
											</div>
										</div>
										<?php 
											require_once('theme/pin-includes/pinterest_feed_api.php');	
											$wl_pffree_options = get_option('weblizar_pffree_options');
											if(isset($wl_pffree_options['PFFREE_Access_Token'])){
											$pinterest_feed_api = new PFFREE_pinterest_feed_api($wl_pffree_options['PFFREE_Access_Token']);
											$board_result = $pinterest_feed_api->add_pffree_board_result();	
											}		
										?>
										<div class="no-pad col-md-12">
											<h3 class="sub_heading"><?php esc_html_e('Pin Settings', PFFREE_TEXT_DOMAIN );?></h3>
											<div class="col-md-12  col-sm-12 col-xs-12 row div-margin">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<label><?php esc_html_e('Pins Template', PFFREE_TEXT_DOMAIN );?></label>
													<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Follow Button Show/hide On/OFF', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
												</div>	
												<div class="col-md-6 col-sm-6 col-xs-6">
													<input data-toggle="toggle" data-offstyle="off" type="checkbox" <?php if($wl_pffree_options['pins_section_onoff']=='on') echo "checked='unchecked'"; ?> id="pins_section_onoff" name="pins_section_onoff">
												</div>							
											</div>
											<div class="board_pins-options <?php if($wl_pffree_options['pins_section_onoff']=='on') echo "active"; ?>" id="board_pins-template">
												<div class="col-md-12 col-sm-12 col-xs-12 row div-margin">			
													<div class="col-md-6 col-sm-6 col-xs-6">
														<label><?php esc_html_e('Board Slug ID ',PFFREE_TEXT_DOMAIN)?></label>
														<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Select a Board Id to show in template', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-6 ">	
														<select  name="pinterest_board_name[]" multiple ="multiple" class="form-control">
															<?php
															foreach($board_result->data as $boards) { 
															$boards_name = str_replace(' ','-',$boards->name);?>
																	<option value="<?php echo esc_attr($boards_name); ?>" <?php if (is_array($wl_pffree_options['pinterest_board_name'])) { foreach($wl_pffree_options['pinterest_board_name'] as $selected_list)
																	{if($selected_list == $boards_name) echo 'selected="selected"';}} ?>><?php esc_html_e( $boards_name,'PFFREE_TEXT_DOMAIN');?></option>
															<?php } ?>
														</select>
													</div>												
												</div>
												
												<div class="col-md-12 col-sm-12 col-xs-12 row  div-margin ">
													<div class="col-md-6 col-sm-6 col-xs-6 ">
														<label><?php esc_html_e('Limits', PFFREE_TEXT_DOMAIN );?></label>
														<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Limits to show pins ', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
													</div>	
													<div class="col-md-6 col-sm-6 col-xs-6">
														<?php $pins_limits_value =$wl_pffree_options['pins_limits_value'];?>
														<select style="max-width:60px;" id="pins_limits_value" name="pins_limits_value" class="form-control">
															<?php for($i=1; $i<=30; $i++){ ?>
															<option value="<?php echo esc_attr($i);?>" <?php echo selected($pins_limits_value, $i ); ?> ><?php esc_html_e($i, PFFREE_TEXT_DOMAIN ); ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-12 col-sm-12 col-xs-12 row my-3 div-margin">
										<div class="col-md-6 col-sm-6  mt-3 col-xs-6">
											<label><?php esc_html_e('Preview', PFFREE_TEXT_DOMAIN );?></label>
											<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Live Preview On/OFF', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
										</div>	
										<div class="col-md-6 col-sm-6  mt-3  col-xs-6">
											<input data-toggle="toggle" data-offstyle="off" type="checkbox" <?php if($wl_pffree_options['pins_preview_onoff']=='on') echo "checked='unchecked'"; ?> id="pins_preview_onoff" name="pins_preview_onoff">
										</div>								
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12 no-pad">
										<h3 class="sub_heading"><?php esc_html_e('Preview', PFFREE_TEXT_DOMAIN );?></h3>	
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12 no-pad pins_preview-options <?php if($wl_pffree_options['pins_preview_onoff']=='on') echo "active"; ?>" id="pins_preview_onoff">
										<style>
											<?php if($wl_pffree_options['pins_section_onoff']=="on") { ?>
													.pinterest-stat-pins{
														display: block;
													}
											<?php } else { ?>
													.pinterest-stat-pins{
														display: none;
													}
											<?php  } ?>
										</style>									
										<script>
											<?php  if($wl_pffree_options['pins_section_onoff']=="on") {?>
													jQuery('.pinterest-stat-board').removeClass('col-md-6');			
													jQuery('.pinterest-stat-follow').removeClass('col-md-6');
													jQuery('.pinterest-stat-board').addClass('col-md-4');
													jQuery('.pinterest-stat-follow').addClass('col-md-4');
											<?php } else { ?>
													jQuery('.pinterest-stat-board').removeClass('col-md-4');
													jQuery('.pinterest-stat-follow').removeClass('col-md-4');
													jQuery('.pinterest-stat-board').addClass('col-md-6');
													jQuery('.pinterest-stat-follow').addClass('col-md-6');
											<?php } ?>
										</script>						
										<?php echo do_shortcode('[pinterest_feed]');?>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12 no-pad pins_preview_off-options <?php if($wl_pffree_options['pins_preview_onoff']=='off') echo "active"; ?>" id="pins_preview_onoff">
										<div id="pinterest_feed1" class="container pinterest-full pinterest-main pinterest_feed1" style='text-align:center'>
											<h2><?php esc_html_e('Live Preview off', PFFREE_TEXT_DOMAIN );?></h2>
										</div>	
									</div>	
								</div>
							</div>
						</div>
					</div>	
					<div class="col-md-12 form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label><?php esc_html_e('Custom CSS', PFFREE_TEXT_DOMAIN );?></label>
							<label><a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('add custom css here', PFFREE_TEXT_DOMAIN ); ?>"><i class="fas fa-info-circle tt-icon"></i></a></label>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<textarea class="form-control" rows="8" cols="8" id="pinterest_custom_css" name="pinterest_custom_css" ><?php if($wl_pffree_options['pinterest_custom_css']!='') { echo esc_attr($wl_pffree_options['pinterest_custom_css']); } ?></textarea>
						</div>	
					</div>			
					<div class="restore">
						<input type="hidden" value="1" id="weblizar_pffree_settings_save_section_general" name="weblizar_pffree_settings_save_section_general" />
						<input class="button left" type="button" name="reset" value="<?php esc_attr_e('Restore Defaults', PFFREE_TEXT_DOMAIN );?>" onclick="weblizar_pffree_option_data_reset('section_general');">
						<input class="button button-primary left" type="button" value="<?php esc_attr_e('Save Options', PFFREE_TEXT_DOMAIN );?>" onclick="weblizar_pffree_option_data_save('section_general')" >
					</div>
				</form>
			</div>
		</div>	
		<div class="col-md-3 form-group">
			<?php $imgpath = PFFREE_PLUGIN_FILE_URL . "options/images/pint.jpg"; ?>
			 <div class="">
	            <div class="update_pro_button_above"><a target="_blank"
	                                              href="https://weblizar.com/plugins/pinterest-feed-pro/"><?php esc_html_e( 'Buy Now $18', PFFREE_TEXT_DOMAIN ); ?></a>
	            </div>
	            <div class="update_pro_image">
	                <img class="pint_getpro" src="<?php echo esc_url($imgpath); ?>">
	            </div>
	            <div class="update_pro_button_below">
	                <a class="upg_anch" target="_blank"
	                   href="https://weblizar.com/plugins/pinterest-feed-pro/"><?php esc_html_e( 'Buy Now $18', PFFREE_TEXT_DOMAIN ); ?></a>
	            </div>
	        </div>
		</div>
		</div>
		<?php 
		$PFFREE_Access_Token = $wl_pffree_options['PFFREE_Access_Token']; 
		if(!empty($PFFREE_Access_Token)){
			require_once('theme/pin-includes/pinterest_feed_api.php');	
			$wl_pffree_options = get_option('weblizar_pffree_options');
			$pinterest_feed_api = new PFFREE_pinterest_feed_api($wl_pffree_options['PFFREE_Access_Token']); 
			$result = $pinterest_feed_api->add_pffree_profile_result();	
		if(isset($result)){
			if($result!= ''){
				$wl_pffree_options['pinterest_user_id'] = $result->data->username;
				update_option('weblizar_pffree_options', $wl_pffree_options);
			} 
		 }elseif($PFFREE_Access_Token!=''){ ?>		
		<div class="col-md-12 form-group">	
			<h1 style="color:red; text-align:center"><?php esc_html_e('Error !!!', PFFREE_TEXT_DOMAIN );?></h1>
			<p style="color:red; text-align:center"><?php esc_html_e('Your Access Token is wrong or Your request limit is exhausted.', PFFREE_TEXT_DOMAIN );?></br><b><?php esc_html_e('You should wait for 1 hour or less to get your limit back.', PFFREE_TEXT_DOMAIN );?></b></p>
		</div>
		<?php $wl_pffree_options['pinterest_user_id'] = '';
				update_option('weblizar_pffree_options', $wl_pffree_options);
				}elseif($PFFREE_Access_Token == ''){
					$wl_pffree_options['pinterest_user_id'] = '';
					update_option('weblizar_pffree_options', $wl_pffree_options);
				} 	
		}else{ ?>
		<div class="col-md-12 form-group">	
			<h1 style="color:red; text-align:center"><?php esc_html_e('Access Token filled is Empty !', PFFREE_TEXT_DOMAIN );?></h1>	
		</div>
		<?php } ?>		
	</div>
	<div class="tab-pane col-md-12 row block ui-tabs-panel deactive" id="get-board-option"> 
		<div class="col-md-9 option"><!-- plugin template selection setting -->				
			<div class="tab-content">
				<div class="col-md-12">
					<div class="col-md-12 form-group">
						<h1 class="main_heading"><?php esc_html_e('Important Note', PFFREE_TEXT_DOMAIN );?></h1></br>
						<b><?php esc_html_e('Multiple outputs by Shortcode :', PFFREE_TEXT_DOMAIN );?></b>
						<p><?php esc_html_e('Please add id with sortcode when one page have multiple outputs ex : ', PFFREE_TEXT_DOMAIN );?> [pinterest_feed id='1234'] </p>				
						<b><?php esc_html_e('Rate limiting :',PFFREE_TEXT_DOMAIN)?></b>
						<p><?php esc_html_e('Each app (with a unique app ID) is allowed 1000 calls per endpoint per hour for each unique user token. The 60-minute window is a sliding window based on when you make your first request. If you hit your rate limit, you’ll only have to wait a max of 1 hour to get a few more requests.',PFFREE_TEXT_DOMAIN)?></p>
						<p><?php esc_html_e('If you exceed your rate limit for a given endpoint, you’ll get a “Your request limit is exhausted.” error Message.',PFFREE_TEXT_DOMAIN)?></p>
						<b><?php esc_html_e('Fetch Response limit :',PFFREE_TEXT_DOMAIN)?></b>
						<p><?php esc_html_e('By default, all fetch requests return the first 100 items in the list. Pinterest API supports the parameters cursor and limit. Use limit to specify the number of items you want in the response. The maximum number of items you can return at one time is 10.',PFFREE_TEXT_DOMAIN)?></p>
						<h3 style='color:red;'><?php esc_html_e(' *Pro Version', PFFREE_TEXT_DOMAIN );?></h3>
						<p><?php esc_html_e('The maximum number of items you can return at one time is 100.',PFFREE_TEXT_DOMAIN)?></p>
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-4 no-pad">
							<h1 class="main_heading"><?php esc_html_e('Section', PFFREE_TEXT_DOMAIN );?></h1>
						</div>
						<div class="col-md-4 no-pad">
							<h1 class="main_heading"><?php esc_html_e('Short-Code', PFFREE_TEXT_DOMAIN );?></h1>
						</div>
						<div class="col-md-4 no-pad">
							<h1 class="main_heading"><?php esc_html_e('Widget Settings', PFFREE_TEXT_DOMAIN );?></h1>
						</div>		
					</div>					
					<div class="col-md-12 form-group">
						<div class="col-md-4">
						<h3><?php esc_html_e('How To Use', PFFREE_TEXT_DOMAIN );?></h3>
						</div>
						<div class="col-md-4">
							</br><b><?php esc_html_e('[pinterest_feed]', PFFREE_TEXT_DOMAIN );?></b>
							<span class="theme_msg"><?php esc_html_e('This ShortCode will paste at page and post content area and get Pinterest configration output', PFFREE_TEXT_DOMAIN );?></span></br>
							<b><?php esc_html_e('[pinterest_profile]', PFFREE_TEXT_DOMAIN );?></b>
							<span class="theme_msg"><?php esc_html_e('This ShortCode will paste at page and post content area and get Pinterest profile output', PFFREE_TEXT_DOMAIN );?></span></br>
							<b><?php esc_html_e('[pinterest_board]', PFFREE_TEXT_DOMAIN );?></b><span style='color:red;'><sup><?php esc_html_e(' *Pro Version', PFFREE_TEXT_DOMAIN );?></sup></span>
							<span class="theme_msg"><?php esc_html_e('This ShortCode will paste at page and post content area and get Pinterest boards output', PFFREE_TEXT_DOMAIN );?></span></br>
							<b><?php esc_html_e('[pinterest_pins]', PFFREE_TEXT_DOMAIN );?></b><span style='color:red;'><sup><?php esc_html_e(' *Pro Version', PFFREE_TEXT_DOMAIN );?></sup></span>
							<span class="theme_msg"><?php esc_html_e('This ShortCode will paste at page and post content area and get Pinterest Pins output', PFFREE_TEXT_DOMAIN );?></span></br>
						</div>
						<div class="col-md-4"></br>
							<b><?php esc_html_e('Pinterest Feed Widget', PFFREE_TEXT_DOMAIN );?></b>
							<span class="theme_msg"><?php esc_html_e('Select widget menu and drag-drop as your choice and get Pinterest configration output', PFFREE_TEXT_DOMAIN );?></span>
						</div>
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-4">
							<h3><?php esc_html_e('Profile', PFFREE_TEXT_DOMAIN );?></h3>
						</div>
						<div class="col-md-4">
							<p class="theme_msg"><?php esc_html_e('Show and Hide Profile section', PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("profile = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("profile_image = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("user_name = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("user_description = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("user_counts = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("user_counts_boards = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("user_counts_pins = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<!--<p><?php //_e("user_counts_likes = 'off'", PFFREE_TEXT_DOMAIN );?></p>-->
							<p><?php esc_html_e("user_counts_following = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("user_counts_followers = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("user_follow = 'off'", PFFREE_TEXT_DOMAIN );?></p>
						</div>
						<div class="col-md-4">
							<b><?php esc_html_e('Profile ON/OFF', PFFREE_TEXT_DOMAIN );?></b>
							<p class="theme_msg"><?php esc_html_e('Show and hide every settings by ON/OFF shortcode attributes', PFFREE_TEXT_DOMAIN );?></p>
						</div>
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-4">
							<h3><?php esc_html_e('Pins', PFFREE_TEXT_DOMAIN );?></h3>
						</div>
						<div class="col-md-4">
							<p class="theme_msg"><?php esc_html_e('Show and Hide Pins section', PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins = 'off'", PFFREE_TEXT_DOMAIN );?></p>
						</div>
						<div class="col-md-4">
							<b><?php esc_html_e('Pins and other related settings ON/OFF', PFFREE_TEXT_DOMAIN );?></b>
							<p class="theme_msg"><?php esc_html_e('Show and hide every settings by ON/OFF shortcode attributes', PFFREE_TEXT_DOMAIN );?></p>
						</div>
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-4">
							<h3><?php esc_html_e('Single board with pins', PFFREE_TEXT_DOMAIN );?><span style='color:red;'><sup><?php esc_html_e(' *Pro Version', PFFREE_TEXT_DOMAIN );?></sup></span></h3>		
						</div>
						<div class="col-md-4"></br>	
							<span class="theme_msg"><?php esc_html_e("Use board='board name' with [pinterest_board] shortcode to show and selected board with it's pins", PFFREE_TEXT_DOMAIN );?></span>
						</div>
						<div class="col-md-4">
						</div>					
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-4">
							<h3><?php esc_html_e('All Pins of single board ', PFFREE_TEXT_DOMAIN );?><span style='color:red;'><sup><?php esc_html_e(' *Pro Version', PFFREE_TEXT_DOMAIN );?></sup></span></h3>
						</div>
						<div class="col-md-4"></br>	
							<span class="theme_msg"><?php esc_html_e("Use board='board name' with [pinterest_pins] shortcode to show all pins of selected board", PFFREE_TEXT_DOMAIN );?></span>
						</div>
						<div class="col-md-4">
						</div>					
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-4">
							<h3><?php esc_html_e('All Pins of multiple boards', PFFREE_TEXT_DOMAIN );?><span style='color:red;'><sup><?php esc_html_e(' *Pro Version', PFFREE_TEXT_DOMAIN );?></sup></span></h3>
						</div>
						<div class="col-md-4"></br>								
							<b><?php esc_html_e("board='board_name1,board_name2,board_name3'", PFFREE_TEXT_DOMAIN );?></b>
							<span class="theme_msg"><?php esc_html_e("For multiple boards pins Use comma{,}  with [pinterest_pins] shortcode to show all pins of selected board", PFFREE_TEXT_DOMAIN );?></span>
						</div>
						<div class="col-md-4">
						</div>					
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-4">
							<h3><?php esc_html_e('Template', PFFREE_TEXT_DOMAIN );?><span style='color:red;'><sup><?php esc_html_e(' *Pro Version', PFFREE_TEXT_DOMAIN );?></sup></span></h3>		
						</div>
						<div class="col-md-4"></br>	
							<b><?php esc_html_e("template='1'", PFFREE_TEXT_DOMAIN );?></b>
							<span class="theme_msg"><?php esc_html_e('To show and select template', PFFREE_TEXT_DOMAIN );?></span>
						</div>
						<div class="col-md-4"></br>
							<b><?php esc_html_e('Template', PFFREE_TEXT_DOMAIN );?></b>
							<span class="theme_msg"><?php esc_html_e('Selected templates and get different outputs', PFFREE_TEXT_DOMAIN );?></span>
						</div>					
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-4">
							<h3><?php esc_html_e('Boards', PFFREE_TEXT_DOMAIN );?><span style='color:red;'><sup><?php esc_html_e(' *Pro Version', PFFREE_TEXT_DOMAIN );?></sup></span></h3>
						</div>
						<div class="col-md-4">
							<p class="theme_msg"><?php esc_html_e('Show and Hide Board section', PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board_name = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board_display = '1' used when outputs have multiple boards", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board = 'board_name' used when outputs have single board", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board_image = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board_description = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board_create = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board_counts = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board_counts_pins = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("board_counts_followers = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><b><?php esc_html_e("Popup slider have Pins section with images ", PFFREE_TEXT_DOMAIN );?></b></p>								
							<p><?php esc_html_e("pins_description = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins_counts = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<!---<p><?php //_e("pins_counts_likes = 'off'", PFFREE_TEXT_DOMAIN );?></p>-->
							<p><?php esc_html_e("pins_counts_comments = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins_counts_repins = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins_user_profile = 'off'", PFFREE_TEXT_DOMAIN );?></p>
						</div>
						<div class="col-md-4">								
							<b><?php esc_html_e('Board and other related settings ON/OFF', PFFREE_TEXT_DOMAIN );?></b>
							<p class="theme_msg"><?php esc_html_e('Show and hide every settings by ON/OFF shortcode attributes', PFFREE_TEXT_DOMAIN );?></p>
						</div>
					</div>
					<div class="col-md-12 form-group">
						<div class="col-md-4">
							<h3><?php esc_html_e('Pins', PFFREE_TEXT_DOMAIN );?><span style='color:red;'><sup><?php esc_html_e(' *Pro Version', PFFREE_TEXT_DOMAIN );?></sup></span></h3>
						</div>
						<div class="col-md-4">
							<p class="theme_msg"><?php esc_html_e('Show and Hide Pins section', PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins = 'off'", PFFREE_TEXT_DOMAIN );?></p>								
							<p><?php esc_html_e("pins_display = '1'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins_image = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins_description = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins_counts = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<!--<p><?php //_e("pins_counts_likes = 'off'", PFFREE_TEXT_DOMAIN );?></p>-->
							<p><?php esc_html_e("pins_counts_comments = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins_counts_repins = 'off'", PFFREE_TEXT_DOMAIN );?></p>
							<p><?php esc_html_e("pins_user_profile = 'off'", PFFREE_TEXT_DOMAIN );?></p>
						</div>
						<div class="col-md-4">
							<b><?php esc_html_e('Pins and other related settings ON/OFF', PFFREE_TEXT_DOMAIN );?></b>
							<p class="theme_msg"><?php esc_html_e('Show and hide every settings by ON/OFF shortcode attributes', PFFREE_TEXT_DOMAIN );?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 form-group">
			<?php $imgpath = PFFREE_PLUGIN_FILE_URL . "options/images/pint.jpg"; ?>
			 <div class="">
	            <div class="update_pro_button_above">
	            	<a target="_blank" href="https://weblizar.com/plugins/pinterest-feed-pro/"><?php esc_html_e( 'Buy Now $18', PFFREE_TEXT_DOMAIN ); ?></a>
	            </div>
	            <div class="update_pro_image">
	                <img class="pint_getpro" src="<?php echo esc_url($imgpath); ?>">
	            </div>
	            <div class="update_pro_button_below">
	                <a class="upg_anch" target="_blank"
	                   href="https://weblizar.com/plugins/pinterest-feed-pro/"><?php esc_html_e( 'Buy Now $18', PFFREE_TEXT_DOMAIN ); ?></a>
	            </div>
	        </div>
		</div>
	</div>
</div>