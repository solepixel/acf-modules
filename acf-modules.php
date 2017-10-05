<?php
/**
 * Plugin Name: ACF Modules
 * Plugin URI: http://www.briandichiara.com/
 * Description: Customizable content modules for modular content.
 * Version: 1.1.0
 * Author: Brian DiChiara
 * Author URI: https://www.briandichiara.com/
 * Text Domain: acfmod
 * License: GNU GPL v2.0
 *
 * @package acf-modules
 */

/*
// Use this snippet to add new modules.

add_filter( 'acfmod/layouts', 'acfmod_layout_[module]', 70 );

function acfmod_layout_[module]( $layouts ) {
	$layouts[] = [module];

	return $layouts;
}

add_filter( 'acfmod/modules/[module]', 'acfmod_modules_[module]' );

function acfmod_modules_[module]() {
	$output = get_sub_field( [module] );
	return $output;
}
*/

define( 'ACFMOD_VERSION', '1.1.0' );
define( 'ACFMOD_PATH', plugin_dir_path( __FILE__ ) );
define( 'ACFMOD_URI', plugin_dir_url( __FILE__ ) );

/* Load Section Module Class */
include_once( ACFMOD_PATH . 'includes/class-acfmod-section.php' );

/* Load up any helper functions */
include_once( ACFMOD_PATH . 'includes/helpers.php' );

/* Create the Modules */
include_once( ACFMOD_PATH . 'includes/init.php' );

/**
 * These hooks/functions do all the magic
 */

add_filter( 'the_content', 'acfmod_insert_modules' );

/**
 * Insert Modules into the_content
 *
 * @param string $content  The WP Content field.
 * @return string          HTML including Modules content
 */
function acfmod_insert_modules( $content = '' ) {
	// Use genesis_before_loop or something else to prevent filtering the_content too soon.
	$after_action = apply_filters( 'acsmod/after_action', '' );

	if ( ! empty( $after_action ) && ! did_action( $after_action ) ) {
		return $content;
	}

	if ( ! function_exists( 'have_rows' ) ) {
		return $content;
	}

	if ( have_rows( '_acfmod_modules' ) ) {
		global $acfmod_sections, $acfmod_section_open;
		$acfmod_sections = 0;
		$acfmod_section_open = false;

		// Truncate anything in the content field.
		$original_content = $content; // probably unnecessary, but what the heck.
		$content = '';

		while ( have_rows( '_acfmod_modules' ) ) :
			the_row();
			$content .= acfmod_module_loop( 'content' );
		endwhile;

		$content .= acfmod_close_sections();

	}

	return $content;
}

global $acfmod_sections, $acfmod_current_section, $acfmod_module_count;

/**
 * Loop through all the modules and return the module HTML
 *
 * @param string $context  Context of the current element.
 * @return string          Module HTML
 */
function acfmod_module_loop( $context = null ) {
	global $acfmod_sections, $acfmod_current_section, $acfmod_module_count;

	if ( ! is_array( $acfmod_sections ) ) {
		$acfmod_sections = array();
	}

	if ( empty( $acfmod_module_count ) ) {
		$acfmod_module_count = 0;
	}

	$content = '';
	$style = '';

	$module = apply_filters( 'acfmod/modules/' . get_row_layout(), '' );
	$styles = get_sub_field( 'module_styles' );

	if ( 'section' === get_row_layout() ) {
		if ( get_sub_field( 'close_previous_section' ) ) {
			$content .= acfmod_close_section();
		}

		$content .= acfmod_open_section();
	}

	if ( $module ) {
		$acfmod_module_count++;
		$col_width = '';
		$section_open = false;

		if ( isset( $acfmod_sections[ $acfmod_current_section ] ) ) {
			$acfmod_sections[ $acfmod_current_section ]->current_col++;
			$col_width = $acfmod_sections[ $acfmod_current_section ]->get_col_width();
			$section_open = $acfmod_sections[ $acfmod_current_section ]->is_open();
		}

		if ( ! empty( $col_width ) || ! empty( $styles ) ) {
			$content .= '<style type="text/css">';

			$content .= '.module.module-' . absint( $acfmod_module_count ) . ',.section.two-column>.module.module-' . absint( $acfmod_module_count ) . ',.section.three-column>.module.module-' . absint( $acfmod_module_count ) . ',.section.four-column>.module.module-' . absint( $acfmod_module_count ) . ' {';

			if ( $col_width ) {
				$content .= 'width: ' . esc_html( $col_width ) . '%;';
			}

			if ( $styles ) {
				$content .= $styles;
			}

			$content .= '}';

			$content .= '</style>';
		}

		$content .= '<div class="module module-' . esc_attr( get_row_layout() ) . ' module-' . esc_attr( $acfmod_module_count ) . '">';

		if ( ! $section_open ) {
			if ( function_exists( 'genesis_structural_wrap' ) ) {
				$content .= genesis_structural_wrap( 'modular-content', 'open', false );
			}
		}

		$content .= '<div class="module-inner">';
			$content .= $module;
		$content .= '</div><!-- .module-inner -->';

		if ( ! $section_open ) {
			if ( function_exists( 'genesis_structural_wrap' ) ) {
				$content .= genesis_structural_wrap( 'modular-content', 'close', false );
			}
		}

		$content .= '</div><!-- .module -->';
	}

	if ( 'section_closer' === get_row_layout() ) {
		$content .= acfmod_close_section();
	}

	return $content;
}

/* add a body class to differentiate content */

add_filter( 'body_class', 'acfmod_modular_body_class' );

/**
 * Add body class for module enabled pages
 *
 * @param array $body_class  Body Classes array.
 * @return array             Potentially modified array
 */
function acfmod_modular_body_class( $body_class ) {
	if ( get_queried_object_id() && have_rows( '_acfmod_modules', get_queried_object_id() ) ) {
		$body_class[] = 'modular';
	}

	return $body_class;
}
