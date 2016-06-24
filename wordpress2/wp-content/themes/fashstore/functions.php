<?php
/**
 * Function describe for FashStore * 
 * 
 * @package FashStore
 */

$fashstore_theme = wp_get_theme();
$fashstore_version = $fashstore_theme->get( 'Version' );

/**
 * Enequeue script for child theme
 */ 
function fashstore_styles_scripts() {
    global $fashstore_version;
    $fashstore_font_args = array(
        'family' => 'Josefin+Sans:400,300,700|Playfair+Display:400,700,900',
        );
    wp_enqueue_style( 'fashstore-google-fonts', add_query_arg( $fashstore_font_args, "//fonts.googleapis.com/css" ) );
    wp_enqueue_style( 'fashstore-parent-styles', get_template_directory_uri() . '/style.css' );    
    wp_enqueue_script( 'fash-custom-script', get_stylesheet_directory_uri() . '/js/fash-custom.js', array('jquery'), esc_attr( $fashstore_version ) );
}
add_action( 'wp_enqueue_scripts', 'fashstore_styles_scripts' );

/*=======================================================================================================================*/  
/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function fashstore_theme_setup() {
    
    load_child_theme_textdomain( 'fashstore', get_stylesheet_directory() . '/languages' );

    /*Fashstore image size*/
    add_image_size( 'fashstore-banner-big', 298, 498, true );
    add_image_size( 'fashstore-banner-small', 280, 358, true );

}
add_action( 'after_setup_theme', 'fashstore_theme_setup' );

/*=======================================================================================================================*/  
/**
 * Changed cart fragment
 */	
add_filter( 'add_to_cart_fragments', 'fashstore_woocommerce_header_add_to_cart_fragment', 15 );
function fashstore_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	$cart_url = $woocommerce->cart->get_cart_url();  
	?>
	<div class="view-cart"><a title="<?php _e( 'View your shopping cart' ,'fashstore' ); ?>" href="<?php echo $cart_url; ?>" class="wcmenucart-contents"><i class="fa fa-shopping-cart"></i> ( <?php echo $woocommerce->cart->cart_contents_count; ?> )</a>
	
	</div>
	<?php
	$fragments['div.view-cart'] = ob_get_clean();
	return $fragments;
}

/*=======================================================================================================================*/
/**
 * Load FashStore widget
 */
require get_stylesheet_directory() . '/inc/widgets/fashstore-products-slider.php';
require get_stylesheet_directory() . '/inc/widgets/fashstore-category-banner.php';

/*=======================================================================================================================*/

/*Add class at add to card button*/
add_filter("woocommerce_loop_add_to_cart_link", 'fashstore_woo_callback_function');

function fashstore_woo_callback_function($product){
    global $product;
    return sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s"><span class="cart-caption">%s</span></a><div class="clearfix"></div>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->id ),
        esc_attr( $product->get_sku() ),
        esc_attr( isset( $quantity ) ? $quantity : 1 ),
        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
        esc_attr( $product->product_type ),
        esc_html( $product->add_to_cart_text() )
    );
}

/*=======================================================================================================================*/
/*fallback function for menu class*/
function fashstore_custom_fallback_menu(){
    $args = array(
        'menu_class'  => 'fashstore-menu',
        'echo'        => true,);
    wp_page_menu( $args );
}