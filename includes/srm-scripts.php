<?php

// Add Scripts
add_action('wp_enqueue_scripts', 'tasty_srm_front_scripts');
function tasty_srm_front_scripts(){

	global $srm_options;


	if( !$srm_options['css']) {
		wp_enqueue_style('srm-styles', plugins_url( 'assets/css/srm-styles.css', dirname(__FILE__) ) );
	}

	if( !$srm_options['images-pop-ups']) {
		wp_enqueue_style('srm-lightbox', plugins_url( 'assets/css/lightbox.css', dirname(__FILE__) ) );
		wp_enqueue_script('srm-lightbox', plugins_url( 'assets/js/public/lightbox.js', dirname(__FILE__) ), array('jquery'), '1.0', true );		
	}

}





// Prevent the admin menu from collapsing & hide view post link
add_action('admin_enqueue_scripts', 'tasty_srm_admin_scripts');
function tasty_srm_admin_scripts(){

	wp_enqueue_script('srm-prevent-collapse', plugins_url( 'assets/js/private/prevent.js', dirname(__FILE__) ), array('jquery'), '1.0', true );
	wp_enqueue_style('srm-admin', plugins_url( 'assets/css/srm-admin.css',  dirname(__FILE__)  ) );
	
}




// Custom CSS
add_action( 'wp_head', 'tasty_srm_custom_css' );
function tasty_srm_custom_css() {

	global $srm_options;

	if( !empty( $srm_options['custom-css'] ) ) {

		$custom_css = $srm_options['custom-css'];

		echo '<style type="text/css">';
		echo $custom_css;
		echo '</style>';
	}
	
} 