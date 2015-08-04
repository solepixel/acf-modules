<?php
/*
Plugin Name: ACF Modules
Plugin URI: http://www.briandichiara.com/
Description: Customizable content modules for modular content.
Version: 1.0.2
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

global $acfmod_sections, $acfmod_current_section, $acfmod_module_count;

function acfmod_module_loop( $context = NULL ){
	global $acfmod_sections, $acfmod_current_section, $acfmod_module_count;

	if( ! is_array( $acfmod_sections ) )
		$acfmod_sections = array();

	if( ! $acfmod_module_count )
		$acfmod_module_count = 0;

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
		$acfmod_module_count++;
		$col_width = '';
		$section_open = false;

		if( isset( $acfmod_sections[ $acfmod_current_section ] ) ){
			$acfmod_sections[ $acfmod_current_section ]->current_col++;
			$col_width = $acfmod_sections[ $acfmod_current_section ]->get_col_width();
			$section_open = $acfmod_sections[ $acfmod_current_section ]->is_open();
		}

		if( $col_width || $styles ):
			$content .= '<style type="text/css">';
				$content .= '.module.module-' . $acfmod_module_count . ',.section.two-column>.module.module-' . $acfmod_module_count . ',.section.three-column>.module.module-' . $acfmod_module_count . ',.section.four-column>.module.module-' . $acfmod_module_count . ' {';
					if( $col_width ):
						$content .= 'width: ' . $col_width . '%;';
					endif;
					if( $styles ):
						$content .= $styles;
					endif;
				$content .= '}';
			$content .= '</style>';
		endif;

		$content .= '<div class="module module-' . get_row_layout() . ' module-' . $acfmod_module_count . '">';
			if( ! $section_open )
				if( function_exists( 'genesis_structural_wrap' ) )
					$content .= genesis_structural_wrap( 'modular-content', 'open', false );

				$content .= '<div class="module-inner">';
					$content .= $module;
				$content .= '</div><!-- .module-inner -->';

			if( ! $section_open )
				if( function_exists( 'genesis_structural_wrap' ) )
					$content .= genesis_structural_wrap( 'modular-content', 'close', false );
		$content .= '</div><!-- .module -->';
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
