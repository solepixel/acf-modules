<?php
/*
Plugin Name: ACF Modules
Plugin URI: http://www.briandichiara.com/
Description: Customizable content modules for modular content.
Version: 1.0.0
Author: Brian DiChiara
Author URI: http://www.briandichiara.com/
Text Domain: acfmod
License: GNU GPL v2.0
*/

/*

# Use this snippet to add new modules

add_filter( 'acfmod/layouts', 'acfmod_layout_[module]', 70 );

function acfmod_layout_[module]( $layouts ){
	$layouts[] = [module];

	return $layouts;
}

add_filter( 'acfmod/modules/[module]', 'acfmod_modules_[module]' );

function acfmod_modules_[module](){
	$output = get_sub_field( [module] );
	return $output;
}

*/

define( 'ACFMOD_VERSION', '1.0.0' );
define( 'ACFMOD_PATH', plugin_dir_path( __FILE__ ) );
define( 'ACFMOD_URI', plugin_dir_url( __FILE__ ) );

/* Load up any helper functions */
include_once( 'includes/helpers.php' );

/* Create the Modules */
include_once( 'includes/init.php' );

/**
 * These hooks/functions do all the magic
 */

add_filter( 'the_content', 'acfmod_insert_modules' );

function acfmod_insert_modules( $content = '' ){
	if( ! did_action( apply_filters( 'acsmod/after_action', 'genesis_before_loop' ) ) )
		return $content;

	if( ! function_exists( 'have_rows' ) )
		return $content;

	if( have_rows( '_acfmod_modules' ) ):
		global $acfmod_sections, $acfmod_section_open;
		$acfmod_sections = 0;
		$acfmod_section_open = false;

		# truncate anything in the content field
		$original_content = $content; // probably unnecessary, but what the heck.
		$content = '';

		while ( have_rows( '_acfmod_modules' ) ) : the_row();
			$content .= acfmod_module_loop( 'content' );
		endwhile;

		$content .= acfmod_close_sections();

	endif;

	return $content;
}

global $acfmod_sections, $acfmod_current_section;

function acfmod_module_loop( $context = NULL ){
	global $acfmod_sections, $acfmod_current_section;

	if( ! is_array( $acfmod_sections ) )
		$acfmod_sections = array();

	$content = '';
	$style = '';

	$module = apply_filters( 'acfmod/modules/' . get_row_layout(), '' );
	$styles = get_sub_field( 'module_styles' );

	if( get_row_layout() == 'section' ){
		if( get_sub_field( 'close_previous_section' ) ){
			$content .= acfmod_close_section();
		}

		$content .= acfmod_open_section();
	}

	if( $module ){
		$col_width = '';
		$section_open = false;

		if( isset( $acfmod_sections[ $acfmod_current_section ] ) ){
			$acfmod_sections[ $acfmod_current_section ]->current_col++;
			$col_width = $acfmod_sections[ $acfmod_current_section ]->get_col_width();
			$section_open = $acfmod_sections[ $acfmod_current_section ]->is_open();
		}

		if( $col_width ){
			$style = ' style="width:' . $col_width . '%;' . $styles . '"';
		} elseif( $styles ) {
			$style = ' style="' . $styles . '"';
		}

		$content .= '<div class="module module-' . get_row_layout() . '"' . $style . '>';
			if( ! $section_open )
				if( function_exists( 'genesis_structural_wrap' ) )
					$content .= genesis_structural_wrap( 'modular-content', 'open', false );

				$content .= '<div class="module-inner">';
					$content .= $module;
				$content .= '</div>';

			if( ! $section_open )
				if( function_exists( 'genesis_structural_wrap' ) )
					$content .= genesis_structural_wrap( 'modular-content', 'close', false );
		$content .= '</div>';
	}

	if( get_row_layout() == 'section_closer' ){
		$content .= acfmod_close_section();
	}

	return $content;
}

/* add a body class to differentiate content */

add_filter( 'body_class', 'acfmod_modular_body_class' );

function acfmod_modular_body_class( $body_class ){
	if( have_rows( '_acfmod_modules' ) && get_queried_object_id() ):
		$body_class[] = 'modular';
	endif;

	return $body_class;
}
