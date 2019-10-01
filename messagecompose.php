<?php
/*
Template Name: messagecompose
*/

get_header();
?>






<?php
/*
Template Name: messageloopnotice
*/

get_header();
?>







<div class="mymessagetitre">
<h2><span>-  My</span> Messages  -</h2>
</div>









<?php do_action( 'bp_before_member_messages_loop' ); ?>

<?php if ( bp_has_message_threads( bp_ajax_querystring( 'messages' ) ) ) : ?>

	<div class="pagination no-ajax" id="user-pag">

		<div class="pag-count" id="messages-dir-count">
			<?php bp_messages_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="messages-dir-pag">
			<?php bp_messages_pagination(); ?>
		</div>

	</div><!-- .pagination -->

	<?php do_action( 'bp_after_member_messages_pagination' ); ?>

	<?php do_action( 'bp_before_member_messages_threads'   ); ?>

	<table id="message-threads" class="messages-notices">
	
	
		<?php while ( bp_message_threads() ) : bp_message_thread(); ?>

			<tr id="m-<?php bp_message_thread_id(); ?>" class="<?php bp_message_css_class(); ?><?php if ( bp_message_thread_has_unread() ) : ?> unread<?php else: ?> read<?php endif; ?>">
				<td width="2%" class="thread-count">
					<span class="unread-count"><?php bp_message_thread_unread_count(); ?></span>
				</td>
				
				
				
				<td width="7%" class="thread-avatar"><?php bp_message_thread_avatar(); ?></td>

				<?php if ( bp_is_active( 'messages', 'star' ) ) : ?>
				
					
					
				<?php endif; ?>

				<?php if ( 'sentbox' != bp_current_action() ) : ?>
					<td width="2%" class="thread-from">
						<?php _e( 'From:', 'buddypress' ); ?> <?php bp_message_thread_from(); ?><br />
						<span class="activity"><?php bp_message_thread_last_post_date(); ?></span>
					</td>
				<?php else: ?>
					<td width="2%" class="thread-from">
						<?php _e( 'To:', 'buddypress' ); ?> <?php bp_message_thread_to(); ?><br />
						<span class="activity"><?php bp_message_thread_last_post_date(); ?></span>
					</td>
				<?php endif; ?>

				<td width="2%" class="thread-info">
					<p><a href="http://www.lookingforpals.com/compose/" title="<?php _e( "View Message", "buddypress" ); ?>"><?php bp_message_thread_subject(); ?></a></p>
					<p class="thread-excerpt"><?php bp_message_thread_excerpt(); ?></p>
				</td>
					
				
			
			<td rowspan="2" width="85%" class="composecell">
		
				
				
			</td>
			
				
				

				<?php do_action( 'bp_messages_inbox_list_item' ); ?>

				
			</tr>
		

		<?php endwhile; ?>
	</table><!-- #message-threads -->

	<div class="messages-options-nav">
		<?php bp_messages_options(); ?>
	</div><!-- .messages-options-nav -->

	<?php do_action( 'bp_after_member_messages_threads' ); ?>

	<?php do_action( 'bp_after_member_messages_options' ); ?>

<?php else: ?>

	<div id="message" data-alert class="alert-box">
		<?php _e( 'Sorry, no messages were found.', 'buddypress' ); ?>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_member_messages_loop' ); ?>


	





















<table id="tabl">
   
   <tr>
       <th>Pour enfants ?</th>
       <td>Non, trop violent</td>
       <td>Oui, adapté</td>
       <td rowspan="2">Pour toute la famille !</td>
   </tr>
   <tr>
       <th>Pour adolescents ?</th>
       <td>Oui</td>
       <td>Pas assez violent...</td>
   </tr>
    <tr>
       <th>Pour adolescents ?</th>
       <td>Oui</td>
       <td>Pas assez violent...</td>
   </tr>
    <tr>
       <th>Pour adolescents ?</th>
       <td>Oui</td>
       <td>Pas assez violent...</td>
	   
   </tr>
</table>

<div class="tableau">

</div>








<div id="message-thread" role="main">

	<?php do_action( 'bp_before_message_thread_content' ); ?>

	<?php if ( bp_thread_has_messages() ) : ?>

		<h3 id="message-subject"><?php bp_the_thread_subject(); ?></h3>

		<p id="message-recipients">
			<span class="highlight">

				<?php if ( !bp_get_the_thread_recipients() ) : ?>

					<?php _e( 'You are alone in this conversation.', 'buddypress' ); ?>

				<?php else : ?>

					<?php printf( __( 'Conversation between %s and you.', 'buddypress' ), bp_get_the_thread_recipients() ); ?>

				<?php endif; ?>

			</span>

			<a class="button confirm tiny radius" href="<?php bp_the_thread_delete_link(); ?>" title="<?php _e( "Delete Message", "buddypress" ); ?>"><?php _e( 'Delete', 'buddypress' ); ?></a> &nbsp;
		</p>

		<?php do_action( 'bp_before_message_thread_list' ); ?>

		<?php while ( bp_thread_messages() ) : bp_thread_the_message(); ?>

			<div class="message-box <?php bp_the_thread_message_alt_class(); ?>">

				<div class="message-metadata">

					<?php do_action( 'bp_before_message_meta' ); ?>
                                        <span class="avatar">
					<?php bp_the_thread_message_sender_avatar( 'type=thumb&width=50&height=50' ); ?>
                                        </span>
                                        <strong><a href="<?php bp_the_thread_message_sender_link(); ?>" title="<?php bp_the_thread_message_sender_name(); ?>"><?php bp_the_thread_message_sender_name(); ?></a> <span class="activity"><?php bp_the_thread_message_time_since(); ?></span></strong>

					<?php do_action( 'bp_after_message_meta' ); ?>

				</div><!-- .message-metadata -->

				<?php do_action( 'bp_before_message_content' ); ?>

				<div class="message-content">

					<?php bp_the_thread_message_content(); ?>

				</div><!-- .message-content -->

				<?php do_action( 'bp_after_message_content' ); ?>

				<div class="clear"></div>

			</div><!-- .message-box -->

		<?php endwhile; ?>

		<?php do_action( 'bp_after_message_thread_list' ); ?>

		<?php do_action( 'bp_before_message_thread_reply' ); ?>

		<form id="send-reply" action="<?php bp_messages_form_action(); ?>" method="post" class="standard-form">

			<div class="message-box">

				<div class="message-metadata">

					<?php do_action( 'bp_before_message_meta' ); ?>

					<div class="avatar-box">
                                            <span class="avatar">
						<?php bp_loggedin_user_avatar( 'type=thumb&height=50&width=50' ); ?>
                                            </span>
						<strong><?php _e( 'Send a Reply', 'buddypress' ); ?></strong>
					</div>

					<?php do_action( 'bp_after_message_meta' ); ?>

				</div><!-- .message-metadata -->

				<div class="message-content">

					<?php do_action( 'bp_before_message_reply_box' ); ?>

					<textarea name="content" id="message_content" rows="15" cols="40"></textarea>

					<?php do_action( 'bp_after_message_reply_box' ); ?>

					<div class="submit">
						<input type="submit" class="button small radius" name="send" value="<?php _e( 'Send Reply', 'buddypress' ); ?>" id="send_reply_button"/>
					</div>

					<input type="hidden" id="thread_id" name="thread_id" value="<?php bp_the_thread_id(); ?>" />
					<input type="hidden" id="messages_order" name="messages_order" value="<?php bp_thread_messages_order(); ?>" />
					<?php wp_nonce_field( 'messages_send_message', 'send_message_nonce' ); ?>

				</div><!-- .message-content -->

			</div><!-- .message-box -->

		</form><!-- #send-reply -->

		<?php do_action( 'bp_after_message_thread_reply' ); ?>

	<?php endif; ?>

	<?php do_action( 'bp_after_message_thread_content' ); ?>

</div>





<?php get_footer();?>













































