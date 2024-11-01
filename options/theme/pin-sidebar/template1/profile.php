<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
if($profile=='on'){ ?>	
<div class="col-md-12 col-sm-4 col-xs-12 pint-no-pad  pinterest-profile profile_template-options <?php if($profile == 'on') echo "active"; ?>" id="profile-template">
	<?php if($profile_image == 'on'){ ?>
	<div class="col-md-12 col-sm-12 col-xs-12 pint-no-pad  pinterest-profile-image profile_img-options <?php if($profile_image == 'on') echo "active"; ?>" id="profile-img">
		<?php foreach($profile_result->data->image as $hello){
				$image = $hello->url;
			}
			$image = str_replace('_60','',$image);
		?>
		<img src="<?php echo esc_url($image); ?>" class="pinterest-img-fix"/>
	</div>	
	<?php } ?>		
			
	<div class="col-md-12 col-sm-12 col-xs-12 pint-no-pad  pinterest-profile-detail">		
		<?php if($user_name == 'on'){ ?>
		<p class="pinterest-profile-name profile_uname-options <?php if($user_name == 'on') echo "active"; ?>" id="profile-uname"><?php esc_html_e($profile_result->data->first_name .' '.$profile_result->data->last_name,PFFREE_TEXT_DOMAIN)?></p>
		<?php } 
		if($user_description=='on'){ ?>			
		<p class="pinterest-profile-description profile_descrip-options <?php if($user_description=='on') echo "active"; ?>" id="profile-udescrip"><?php esc_html_e($profile_result->data->bio,PFFREE_TEXT_DOMAIN)?></p>
		<?php } ?>
	</div>
</div>
<?php } ?>
<?php if($user_counts == 'on'){ ?>
	<div class="col-md-12 col-sm-8 col-xs-12 pint-no-pad  pinterest-stat-left user_counts-options <?php if($user_counts == 'on') echo "active"; ?>" id="user_counts-template">		
		<?php if($user_counts_followers == 'on'){ ?>
		<div class="col-md-12 col-sm-12 col-xs-12 pinterest-stat-default pinterest-stat-followers user_followers-options <?php if($user_counts_followers == 'on') echo "active"; ?>" id="count-number">
			<div class="followers-desc icon-desc">
				 <small class="pinterest-timer count-title" data-to="<?php echo esc_attr($profile_result->data->counts->followers); ?>" data-speed="1500"></small>
			 </div>
			<p class="count-text "><?php esc_html_e('Followers', PFFREE_TEXT_DOMAIN );?></p>
		</div>
		<?php } ?>
		<?php if($user_counts_following =='on'){ ?>
		<div class="col-md-12 col-sm-12  col-xs-12 pinterest-stat-default pinterest-stat-following user_following-options <?php if($user_counts_following == 'on') echo "active"; ?>" id="count-number">
			<div class="following-desc icon-desc">
				 <small class="pinterest-timer count-title" data-to="<?php echo esc_attr($profile_result->data->counts->following); ?>" data-speed="1500"></small>
			 </div>
			<p class="count-text"><?php esc_html_e('Following', PFFREE_TEXT_DOMAIN );?></p>
		</div>
		<?php } ?>
		
	</div>
	<?php } ?>
<div class="col-md-12 col-sm-12 pint-no-pad col-xs-12 pinterest-stats">		
	<div class="col-md-12 col-sm-12 col-xs-12 pint-no-pad  pinterest-stat-left">					
		<div class="col-md-12 col-sm-12  col-xs-12 pinterest-stat-default pinterest-stat-pins">
			<div class="icon-desc-default">
				<div class="pins-desc icon-desc">
				<?php if($pins=='on'){ ?>
				<span href="javascript:void(0)" class="tablinks_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?> board_pins-options <?php if($pins=='on') echo "active"; ?>" id="board_pins-template" onclick="opentab_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>(event, 'Pins_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>')">	
				<?php }if($user_counts == 'on'){ ?>
				<span class="user_counts-options <?php if($user_counts == 'on') echo "active"; ?>">	
				<?php if($user_counts_pins=='on'){ ?>							
				<small id="count-number" data-to="<?php echo esc_attr($profile_result->data->counts->pins); ?>" data-speed="1500" class="pinterest-timer count-title user_c_pins-options <?php if($user_counts_pins =='on') echo "active"; ?>"></small>				
				<?php } ?>	
				</span>
				<?php } ?>	
				<span class="count-text "><?php esc_html_e('Pins', PFFREE_TEXT_DOMAIN );?></span></span>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 pinterest-stat-default pinterest-stat-board">
			<div class="icon-desc-default">
				<div class="board-desc icon-desc">
				<?php if($boards=='on'){ ?>				
				<span href="javascript:void(0)" class="tablinks_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?> boards_template-options <?php if($boards=='on') echo "active"; ?>" id="boards-template" onclick="opentab_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>(event, 'Boards_<?php if(isset($pinterest_api_id)){ echo esc_attr($pinterest_api_id);} ?>')">
				<?php }if($user_counts == 'on'){ ?>
				<span class="user_counts-options <?php if($user_counts == 'on') echo "active"; ?>">
				<?php if($user_counts_boards =='on'){ ?>
				<small class="pinterest-timer count-title user_c_board-options <?php if($user_counts_boards =='on') echo "active"; ?>" id="count-number" data-to="<?php echo esc_attr($profile_result->data->counts->boards); ?>" data-speed="1500"></small>
				<?php } ?>	
				</span>
				<?php } ?>				 
				<span class="count-text "><?php esc_html_e('Boards', PFFREE_TEXT_DOMAIN );?></span></span>
				 </div>
			 </div>
		</div>			
	</div>	
</div>