<?php
/**
 * @package WordPress
 * @subpackage Sweetdate
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Sweetdate 1.0
 */


/**
 * Sweetdate Child Theme Functions
 * Add extra code or replace existing functions
*/ 

/* register js */

define('CHILD_URL', get_stylesheet_directory_uri() );


add_action('after_setup_theme','kleo_my_member_data');
function kleo_my_member_data() 
{
    global $kleo_config;
    //this is the details field, right now it take the "About me" field content
	
    $kleo_config['bp_members_details_field'] = 'About me';
    //this display the fields under the name, eq: 36 / Woman / Divorced / Berlin. Modify with the names of the fields you want to appear there
    $kleo_config['bp_members_loop_meta'] = array(
       
        'country',
        'City'
    );
      
}


//INSTANT CHAT ONLY FOR VIP (FONCTIONNEL)
function ChatCheckMemberships() {
 
if(pmpro_hasMembershipLevel(array(1), get_current_user_id())){
    echo '
<link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" href="/arrowchat/external.php?type=css" charset="utf-8" />	
<script type="text/javascript" src="/arrowchat/external.php?type=djs" charset="utf-8"></script>
<script type="text/javascript" src="/arrowchat/external.php?type=js" charset="utf-8"></script>

';}
}
add_action('wp_head', 'ChatCheckMemberships');


//DIFFERENT frontpage POUR LOGOUT OU LOGIN
function switch_homepage() {
    if ( is_user_logged_in() ) {
        $page = 1027; // for logged in users
        update_option( 'page_on_front', $page );
        update_option( 'show_on_front', 'page' );
    } else {
        $page = 844; // for logged out users
        update_option( 'page_on_front', $page );
        update_option( 'show_on_front', 'page' );
    }
}
add_action( 'init', 'switch_homepage' );


//DIFFERENT MENU POUR LOGOUT OU LOGIN
function my_wp_nav_menu_args( $args = '' ) {

if( is_user_logged_in() ) { 
	$args['menu'] = 'sweetdate';
} else { 
	$args['menu'] = 'loggedout';
} 
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );






//MAN AS REGULAR MEMBER
/**
* When registering, add the member to a specific membership level
* based on the field value he has selected
*
* @global object $wpdb
* @global object $bp
* @param integer $user_id
*/
function kleo_pmpro_default_level($user_id) {
    global $wpdb, $bp;
 
    //Change this with your field name
    $field_name= "sex";
 
    //Change the field value
    $value_to_match = "Woman";
 
    //Membership level id
    $membership_level = 1;
 
    //Done editing
    $field_id = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$bp->profile->table_name_fields} WHERE name = %s", $field_name ) );
    if ($_POST['field_'.$field_id] == $value_to_match) {
            pmpro_changeMembershipLevel($membership_level, $user_id);
    }
}
 
function kleo_mu_pmpro_default_level($user_id, $password, $meta) {
    global $bp, $wpdb;
 
    //Change this with your field name
    $field_name= "sex";
 
    //Change the field value
    $value_to_match = "Man";
 
    //Membership level id
    $membership_level = 1;
 
    
    //Done editing
    $field_id = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$bp->profile->table_name_fields} WHERE name = %s", $field_name ) );
    $field_value = $meta['field_'.$field_id];
    if ( $field_value == $value_to_match ) {
        pmpro_changeMembershipLevel($membership_level, $user_id);
    }
}
 
if (is_multisite()) {
    add_action( 'wpmu_activate_user', 'kleo_mu_pmpro_default_level', 10, 3);
} else {
    add_action('user_register', 'kleo_pmpro_default_level');
}



/* Check the Countries is isset or not USELESS POUR LA PAGE MEMBERS*/
function convert_location($country,$sex) {


    $countries = array(
                    'Korea' => 'kr',
                    'Nepal' =>'Nepal',
                    'Greece' => 'greece',
                    'France'=>'France2',
                    'Afganistan' =>'af',
                    'Inida' => 'in',
                    'Algeria' =>'Algeria',
                    'Brazil' => 'br',
                    'Canada' =>'ca',
                    'American Soma'=>'us',
                    'Belgium' =>'be',
                    'Colombia'=>'co',
                    'Morocco' =>'Morocco',
                    'China'=> 'China',
					'Russia'=> 'Russia',
                    'Italy' => 'Italy',
					'United Kingdom' => 'United Kingdom',
					'Spain' => 'Spain',
					'Egypt' => 'Egypt',
					
					'Man' => 'Man',
                    'Woman' =>'Woman',
                    'Transgender' => 'Transgender',
					
					'beginner' => 'beginner',
                    'intermediate' =>'intermediate',
                    'advanced' => 'advanced',
					'fluent' => 'fluent',
					'native' => 'native'
					
					
                );
				
				
	
   
    if (isset($countries[$country])) {
        return $countries[$country];
		
    }
	
	  if (isset($countries[$sex])) {
        return $countries[$sex];
		
    }
	



}




/* Check the Countries is isset or not */
function check_visited_countries($val) {
	
	$count = 0; 
    $visited_countries = array(
                    'France' => 'francev',
                    'Egypt' =>'egyptv',
                    'Italy' => 'italyv',
					'Greece' => 'greecev',
					'Norway' => 'norwayv',
					'Russia' => 'russiav',
					'Morocco' => 'moroccov',
					'Spain' => 'spainv',
					'United-Kingdom' => 'ukv',
					'China' => 'chinav',
					'Turkey' => 'turkeyv',
					'Usa' => 'usav',
					'Germany' => 'germanyv',
					'Japan' => 'japanv',
					'Emirate' => 'emiratev',
					'Brazil' => 'brazilv',
					'Australia' => 'australiav',
					
					'Friendship' => 'friendship',
					'Hoster' => 'hoster',
					'Email Pen Pals' => 'email_pen_pals',
					'Language Exchange' => 'language_exchange',
					'Romance / Flirting' => 'romance',
					'Travellers' => 'traveller'
					
					
					
                );
		
	while( $count < count($val)){
		if(isset($visited_countries[$val[$count]])){
			$value[$count] = $visited_countries[$val[$count]];
		} 
		
		
		$count++;
	}
	
	
	
	
	return $value;
	
	
		
}








//$visited_countries = $_POST['field_1091_0'][The France];


?>

                    