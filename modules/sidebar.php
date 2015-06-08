<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_sidebar', 72 );

function acfmod_layout_sidebar( $layouts ){
	if( ! class_exists( 'acf_field_sidebar_selector' ) )
		return $layouts;

	$layouts[] = array (
		'key' => '556a634ee6232',
		'name' => 'sidebar',
		'label' => 'Sidebar',
		'display' => 'block',
		'sub_fields' => array (
			array (
				'key' => 'field_556a63567c806',
				'label' => 'Sidebar',
				'name' => 'sidebar',
				'type' => 'sidebar_selector',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'allow_null' => 1,
				'default_value' => '',
			),
			array (
				'key' => 'field_556a636c7c807',
				'label' => 'Module Styles',
				'name' => 'module_styles',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		'min' => '',
		'max' => '',
	);

	return $layouts;
}

add_filter( 'acfmod/modules/sidebar', 'acfmod_modules_sidebar' );

function acfmod_modules_sidebar(){
	$output = '';

	$sidebar = get_sub_field( 'sidebar' );

	if( $sidebar && is_active_sidebar( $sidebar ) ):

		ob_start();
		dynamic_sidebar( $sidebar );
		$output = ob_get_clean();

	endif;

	return $output;
}
