<?php
/**
 * Initialization: Grab Module Includes, setup Modules
 *
 * @package acf-modules
 */

// Autoload all modules, excluding helpers.
foreach ( glob( ACFMOD_PATH . 'modules/[!_]*.php' ) as $file ) {
	include_once $file;
}

// ACF Fields Setup.
add_action( 'init', 'acfmod_init' );

/**
 * Initialize ACF Modules
 */
function acfmod_init() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {

		$layouts = apply_filters( 'acfmod/layouts', array() );

		acf_add_local_field_group(array(
			'key' => 'acfmod_modules_group',
			'title' => 'Content Modules',
			'fields' => array(
				array(
					'key' => 'acf_modules_field',
					'label' => 'Modules',
					'name' => '_acfmod_modules',
					'type' => 'flexible_content',
					'instructions' => 'Create many different types of content by selecting the module and filling in the fields.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'button_label' => 'Add Module',
					'min' => 0,
					'max' => '',
					'layouts' => $layouts,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'page',
					),
				),
			),
			'menu_order' => 1,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => array(
				0 => 'the_content',
				1 => 'excerpt',
			),
		));

	}
}
