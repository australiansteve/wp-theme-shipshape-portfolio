<?php
/**
 * Shipshapeportfolio Theme Customizer
 *
 * @package Shipshapeportfolio
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shipshapeportfolio_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Background Image! */
	$wp_customize->add_setting( 'backgroundimage' , array(
	    'default'     => '',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'backgroundimage', array(
		'label'        => __( 'Background Image', 'shipshapeportfolio' ),
		'section'    => 'images',
		'settings'   => 'backgroundimage',
	) ) );

	$wp_customize->get_setting( 'backgroundimage' )->transport = 'postMessage';

}
add_action( 'customize_register', 'shipshapeportfolio_customize_register' );

function shipshapeportfolio_add_section( $wp_customize ) {
   $wp_customize->add_section('images', array(
	    'title'      => __('Images','shipshapeportfolio'),
	    'priority'   => 30,
	) );
}
add_action( 'customize_register', 'shipshapeportfolio_add_section' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shipshapeportfolio_customize_preview_js() {
	wp_register_script( 'shipshapeportfolio_customizer', get_template_directory_uri().'/inc/js/customizer.js', array( 'jquery', 'customize-preview' ), '20151220', true );

	$translation_array = array( 
		'siteurl' => get_option('siteurl'), 
		'blogname' => get_option('blogname') 
	);

	wp_localize_script( 'shipshapeportfolio_customizer', 'WPVARS', $translation_array );

	wp_enqueue_script( 'shipshapeportfolio_customizer' );
}
add_action( 'customize_preview_init', 'shipshapeportfolio_customize_preview_js' );

function shipshapeportfolio_customize_css()
{
    ?>
        <style type="text/css">
            #bgImage { 
             	background-image: url(<?php echo get_theme_mod('backgroundimage'); ?>); 
            }

        </style>
    <?php
}
add_action( 'wp_head', 'shipshapeportfolio_customize_css');
