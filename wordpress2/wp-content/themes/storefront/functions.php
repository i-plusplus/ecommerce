<?php
/**
 * storefront engine room
 *
 * @package storefront
 */

/**
 * Initialize all the things.
 */
require get_template_directory() . '/inc/init.php';

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woothemes/theme-customisations
 */

add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
    if (is_user_logged_in() && $args->theme_location == 'secondary') {
        $items .= '<li><a href="'. wp_logout_url(home_url()) .'">Log Out</a></li>';
    }
    elseif (!is_user_logged_in() && $args->theme_location == 'secondary') {
        $items .= '<li><a href="'. site_url('my-account') .'">Log In</a></li>';
    }
    return $items;
}
add_action( 'init', 'storefront_custom_logo' );
function storefront_custom_logo() {
	remove_action( 'storefront_header', 'storefront_site_branding', 20 );
	add_action( 'storefront_header', 'storefront_display_custom_logo', 20 );
}

function storefront_display_custom_logo() {
?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>" />
	</a>
<?php
}

add_action( 'get_header', 'remove_storefront_sidebar' );
function remove_storefront_sidebar(){
	if ( is_product() ) {
		remove_action( 'storefront_sidebar', 'storefront_get_sidebar',			10 );

?>
       	<style>
		body.woocommerce #primary { width: 100%; }
	</style>
<?php

	}
}
