<?php
if ( ! defined( 'ABSPATH' ) ) exit;
include PFFREE_PLUGIN_URL .'options/theme/pin-includes/widget_shortcode_data.php';
$PFFREE_Access_Token = $wl_pffree_options['PFFREE_Access_Token'];
if(!empty($PFFREE_Access_Token)){
if(isset($profile_result)){	?>
<style>

.container.pinterest-main #Boards_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?> .boards_template-options,
.container.pinterest-main #Pins_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>
{
    overflow-y: scroll;
    width: 100%;
    position: relative;
    left: 0px;
	max-height:400px;
}
.container.pinterest-main #Boards_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?> .boards_template-options::-webkit-scrollbar,
.container.pinterest-main #Pins_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>::-webkit-scrollbar{
    width: 5px;
}

.container.pinterest-main #Boards_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?> .boards_template-options::-webkit-scrollbar-track,
.container.pinterest-main #Pins_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 8px rgba(0,0,0,0.3);
}

.container.pinterest-main #Boards_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?> .boards_template-options::-webkit-scrollbar-thumb,
.container.pinterest-main #Pins_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>::-webkit-scrollbar-thumb {
  background-color: #bd081c ;
  outline: 1px solid slategrey;
}
</style>
<?php include('template1/profile.php'); // Profile Section ?>
<?php if(isset($board_result)){
	if($board_result!= ''){ ?>
		<?php include('template1/pins.php'); // pins Section ?>
<?php } } ?>
<?php if($user_follow == 'on'){ ?>
		<div class="col-md-12 col-sm-12 col-xs-12 pinterest-stat-default pinterest-stat-follow user_follow-options <?php if($user_follow =='on') echo "active"; ?>">
			<div class="icon-desc-default">
				<a target='_blank' href="<?php echo esc_url($profile_result->data->url);?>">
				<i class="fas fa-paper-plane"></i> <?php esc_html_e('Follow', PFFREE_TEXT_DOMAIN );?></a>
			</div>
		</div>
	<?php } ?>
</div>
<?php if($pins=='off'){ ?>
	<style>
	.container.pinterest-main #Boards_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>{
		display:block;
	}
	.tablinks_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>.boards_template-options .count-text {

		width: 100%;
	}
	.tablinks_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>.boards_template-options{
		color: #333;
		padding: 0px;
		background: none;
		font-size: inherit;
		font-weight: normal;
		line-height: inherit;
		 -webkit-transition: all 0.5s ease-in-out;
		  -moz-transition:all 0.5s ease-in-out;
		  -o-transition:all 0.5s ease-in-out;
		  transition:all 0.5s ease-in-out;
	}
	.pinterest-sidebar .pinterest-stat-follow a{
		margin: 4px 0px;
	}
	.pinterest-sidebar .pinterest-stat-board a{
		margin: 0px !important;
	}
	</style>
	<script>
		jQuery(document).ready(function() {
			jQuery(".tablinks_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>").on('click', function(){
			 jQuery('#Boards_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?> .boards_template-options').toggle();
			});
		});
	</script>
<?php } ?>
<?php if($boards=='off'){ ?>
<style>
	.container.pinterest-main #Pins_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>{
		display:block;
	}
	.tablinks_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>.board_pins-options .count-text {

		width: 100%;
		font-weight: bold;
	}
	.tablinks_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>.board_pins-options{
		color: #333;
		padding: 0px;
		background: none;
		font-size: inherit;
		font-weight: normal;
		line-height: inherit;
	}
	.container.pinterest-main #Pins_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?> .pins_section-options{
display:block;
		 -webkit-transition: all ease 1.6s;
		  -moz-transition: all ease 1.6s;
		  -o-transition: all ease 1.6s;
		 transition: all ease-in-out 1.6s;
	}
	.pinterest-sidebar .pinterest-stat-follow a{
		margin: 4px 0px;
	}
	.pinterest-sidebar .pinterest-stat-pins a{
		margin: 0px !important;
	}
	</style>
<script>
	jQuery(document).ready(function() {
		jQuery(".tablinks_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>").on('click', function(){
		 jQuery('#Pins_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?> .pins_section-options').toggle();
		});
	});
</script>
<?php } ?>
<?php }elseif($PFFREE_Access_Token!=''){ ?>
	<div class="alert-danger col-md-12">
			<h4 style="color:red; text-align:center;margin:0;padding:10px"><?php esc_html_e('Error !!!', PFFREE_TEXT_DOMAIN );?></h4>
			<p style="color:red; text-align:center"><?php esc_html_e('Your Access Token is wrong or Your request limit is exhausted.', PFFREE_TEXT_DOMAIN );?></br><b><?php esc_html_e('You should wait for 1 hour or less to get your limit back.', PFFREE_TEXT_DOMAIN );?></b></p>
			</div>
		<?php
			$wl_pffree_options['pinterest_user_id'] = '';
			update_option('weblizar_pffree_options', $wl_pffree_options);
			}elseif($PFFREE_Access_Token == ''){
				$wl_pffree_options['pinterest_user_id'] = '';
				update_option('weblizar_pffree_options', $wl_pffree_options);
			}
	}else{ ?>
		<div class="alert-danger col-md-12">
			<h4 style="color:red; text-align:center;margin:0;padding:10px"><?php esc_html_e('Pinterest Access Token filled is Empty !', PFFREE_TEXT_DOMAIN );?></h4>
		</div>
<?php }  ?>
