<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>


<?php
/***
 * If you'd like to show specific profile fields here use:
 * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
 */
 do_action( 'bp_profile_header_meta' );
 ?>

<div class="five columns">

    <?php
    /**
     * kleo_bp_before_profile_name hook
     *
     * @hooked kleo_bp_compatibility_match - 20
     */
     do_action( 'kleo_bp_before_profile_name' );
     ?>
    <div class="custom-wrapper">
        <div class="country-flag">
            <?php 

                $userid  = bp_get_member_user_id(); 
                $country = xprofile_get_field_data( 'country', $userid );

                $gif = convert_location($country);

                if( !empty($gif) ) {
                    echo '<img src="'.CHILD_URL.'/flags/'.$gif.'.png" border=0>';
                }

             ?> 
        </div>
		
		<div class="gendericons">
            <?php 

                $userid  = bp_get_member_user_id(); 
                $sex = xprofile_get_field_data( 'I am a', $userid );

                $gif = convert_location($sex);

                if( !empty($gif) ) {
                    echo '<img src="'.CHILD_URL.'/gender/'.$gif.'.png" border=0>';
                }

             ?> 
        </div>
		
        <div class="profile-title">
            <h2><?php bp_displayed_user_fullname(); ?></h2>
            <span class="user-nicename">@<?php bp_displayed_user_username(); ?></span>
            <span class="activity"><i class="icon-time"></i> <?php bp_last_activity( bp_displayed_user_id() ); ?></span>
        </div>
    </div>
		
	<?php do_action( 'bp_before_member_header_meta' ); ?>
		
    <?php 
    /**
     * kleo_bp_after_profile_username
     *
     * @hooked kleo_membership_info - 10
     */
    do_action('kleo_bp_after_profile_name');
    ?>
    <p>&nbsp;</p>

    <div class="row">
        <div id="item-header-avatar" class="eight columns image-hover">
            <?php bp_displayed_user_avatar( array('type' =>'full','width' => 580, 'height' => 580) ); ?>
			 <?php
            /**
             * kleo_bp_after_profile_image
             *
             * @hooked kleo_bp_profile_photo_change - 10
             */
             do_action( 'kleo_bp_after_profile_image' );
             ?>
			
        </div>

        <?php do_action('kleo_bp_header_actions');?>
		
    </div><!--end row-->
</div><!--end five-->

<?php do_action( 'bp_after_member_header' ); ?>

<?php do_action( 'template_notices' ); ?>