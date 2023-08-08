<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

// END ENQUEUE PARENT ACTION


/**
 * ENQUEUE BOOTSTRAP 5
 */

 function enqueue_bootstrap()
 {
     wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css', array(), '5.0.0');
     wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js', array('jquery'), '5.0.0', true);
 }
 add_action('wp_enqueue_scripts', 'enqueue_bootstrap');


/**
 * HANDLE LOGIN TEXT CHANGE ON USER LOGIN
 */

 function changeBtnTextOnUserLogin()
 {
 
     if (is_user_logged_in()) {
 
         //change text to Logout
         return 'Sign out';
     } else {
 
         //change text to Login
         return 'Get Loan';
     }
 }
 add_shortcode('changeBtnTextOnUserLogin', 'changeBtnTextOnUserLogin');
 
 /**
  * HANDLE LOGIN LINK CHANGE ON USER LOGIN
  */
 
 function changeBtnLinkOnUserLogin()
 {
     $base_link = site_url();
 
     if (is_user_logged_in()) {
 
         return wp_logout_url(home_url());
     } else {
 
         return $base_link;
     }
 }
 add_shortcode('changeBtnLinkOnUserLogin', 'changeBtnLinkOnUserLogin');

 /**
 * HANDLE CTA BUTTON TEXT CHANGE ON USER LOGIN
 */

function ctaBtnTextChangeOnUserLogin()
{

	if (is_user_logged_in()) {

		//change text to Logout
		return 'Sign Out';
	} else {

		//change text to Login
		return 'Get Loan';
	}
}
add_shortcode('ctaBtnTextChangeOnUserLogin', 'ctaBtnTextChangeOnUserLogin');

/**
 * HANDLE CTA LINK CHANGE ON USER LOGIN
 */

function ctaBtnLinkChangeOnUserLogin()
{
	$base_link = site_url();

	if (is_user_logged_in()) {

		$base_link = site_url();

		return $base_link . '/?page_id=359';
	} else {

		return $base_link . '/?page_id=297';
	}
}
add_shortcode('ctaBtnLinkChangeOnUserLogin', 'ctaBtnLinkChangeOnUserLogin');


 /**
 * INCLUDE Loan Form File
*/
include ABSPATH . 'wp-content/plugins/getloan/getloan.php';
include ABSPATH . 'wp-content/themes/astra-child/all-user-details.php';
include ABSPATH . 'wp-content/themes/astra-child/loan-user-table.php';
include ABSPATH . 'wp-content/themes/responsive-child/loggedin-loan-form.php';
// include ABSPATH . 'wp-content/themes/responsive-child/complete-order.php';
