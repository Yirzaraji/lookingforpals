<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_members_loop' ); ?>


<?php if ( bp_has_members( bp_ajax_querystring( 'members' ). '&per_page=16'.sq_option('buddypress_perpage') ) ) : ?>


<div class="search2">
  <?php

echo do_shortcode( '[su_spoiler title="OPEN Advanced Search Tab" style="fancy" icon="caret"][kleo_search_members_horizontal before="" button=1][/su_spoiler]' );
 ?></div>
 
 
	<?php do_action( 'bp_before_directory_members_list' ); ?>
        
  <div class="item-list search-list" id="members-list">
    <?php while ( bp_members() ) : bp_the_member(); ?>

      <div class="three columns">
        <div class="search-item">
          <div class="avatar">
            <a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar('type=full&width=94&height=94&class='); ?></a>
            <?php do_action('bp_members_inside_avatar');?>
          </div>
		  
		  
          <div class="country-flag">
            <?php 

                //global $bp;
                
                $userid  = bp_get_member_user_id();  //$bp->loggedin_user->userdata->ID;

                // var_dump($userid);

                $country = xprofile_get_field_data( 'country', $userid );


 {
                    echo '<img src="'.CHILD_URL.'/flags/'.$country.'.png" border=0>';
                }

             ?> 
          </div>
		  
			  <div class="gendericons">
				<?php 

					//global $bp;
					
					$userid  = bp_get_member_user_id();  //$bp->loggedin_user->userdata->ID;

					//var_dump($userid);

					$sex = xprofile_get_field_data( 'sex', $userid );

					{
						echo '<img src="'.CHILD_URL.'/gender/'.$sex.'.png" border=0>';
					}

				 ?> 
			  </div>
		  
            <?php do_action('bp_members_meta');?>
          <div class="search-body">
              <?php do_action( 'bp_directory_members_item' ); ?>
          </div>
          <div class="bp-member-dir-buttons">
          <?php do_action('bp_directory_members_item_last');?>
          </div>
        </div>
      </div>

    <?php endwhile; ?>
  </div>

	<?php do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

  <!-- Pagination -->
  <div class="row">
      <div  class="twelve columns pagination-centered">
          <div class="pagination" id="pag-bottom">
              <div id="member-dir-pag-bottom" class="pagination-links">
              <?php bp_members_pagination_links(); ?>
              </div>
          </div>
      </div>
  </div>
  <!--end  Pagination-->
<?php else: ?>

	<div id="message" class="alert-box">
		<?php _e( "Sorry, no members were found.", 'kleo_framework'); ?>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ); ?>
