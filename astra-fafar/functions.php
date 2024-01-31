<?php
/**
 * astra-fafar Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package astra-fafar
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_FAFAR_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-fafar-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_FAFAR_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


function add_header_custom_scripts(){
	?>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<?php
}

add_action( 'wp_head', 'add_header_custom_scripts' );

function add_footer_custom_scripts(){
	?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<?php
}

add_action( 'wp_footer', 'add_footer_custom_scripts' );



/*
 *	
 *	
 *	
 *	
 *	
 *	
 *	
 *	
 *	
 *	    <<<<<<<<<<<<< START >>>>>>>>>>>
 *		ADDED BY Setor de Suporte e T.I. 
*/


/**
 * Register Custom Navigation Walker
 */
function register_fafar_menu_walker(){
	require_once get_theme_file_path() . '/class-wp-fafar-menu-walker.php';
}
add_action( 'after_setup_theme', 'register_fafar_menu_walker' );


/*
 *	Register FAFAR Custom Banner 
 * */
function register_fafar_custom_banner(){
	require_once get_theme_file_path() . '/banner.php';
}
add_action( 'after_setup_theme', 'register_fafar_custom_banner' );

/*
 * Changing "Read More" button text  
 */
function new_astra_read_more_button() { return __( 'Leia Mais »', 'astra' ); }

add_filter( 'astra_post_read_more', 'new_astra_read_more_button' );
