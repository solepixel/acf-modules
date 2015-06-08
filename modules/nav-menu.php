<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_nav_menu', 69 );

function acfmod_layout_nav_menu( $layouts ){
	if( ! class_exists( 'ACF_Nav_Menu_Field_Plugin' ) )
		return $layouts;

	$layouts[] = array (
		'key' => '546f12849fd3a',
		'name' => 'nav_menu',
		'label' => 'Nav Menu',
		'display' => 'row',
		'sub_fields' => array (
			array (
				'key' => 'field_546f12849fd3ab',
				'label' => 'Menu',
				'name' => 'menu',
				'type' => 'nav_menu',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'save_format' => 'object',
				'container' => 0,
				'allow_null' => 0,
			),
			array (
				'key' => 'field_546f12849fd3ac',
				'label' => 'Module Styles',
				'name' => 'module_styles',
				'type' => 'text',
				'instructions' => 'Apply CSS directly to the module container element. Use to tweak positioning/layouts to perfection.',
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

add_filter( 'acfmod/modules/nav_menu', 'acfmod_modules_nav_menu' );

function acfmod_modules_nav_menu(){
	$output = '';

	$menu = get_sub_field( 'menu' );

	if( $menu ):

		$output .= '<div class="menu-wrapper menu-' . $menu->slug . '">';

			$output .= wp_nav_menu( array(
				'echo' => false,
				'menu' => $menu->ID,
				'menu_class' => 'menu'
			));

		$output .= '</div>';

	endif;

	return $output;
}
