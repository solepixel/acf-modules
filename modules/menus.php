<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_menus', 70 );

function acfmod_layout_menus( $layouts ) {
	if ( ! class_exists( 'ACF_Nav_Menu_Field_Plugin' ) )
		return $layouts;

	$layouts[] = array(
		'key' => '544f16844fb3a',
		'name' => 'menus',
		'label' => 'Menus',
		'display' => 'row',
		'sub_fields' => array(
			array(
				'key' => 'field_544f16894fb3b',
				'label' => 'Custom Menus',
				'name' => 'custom_menus',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'min' => '',
				'max' => '',
				'layout' => 'table',
				'button_label' => 'Add Menu',
				'sub_fields' => array(
					array(
						'key' => 'field_544f1eeff9eb0',
						'label' => 'Menu',
						'name' => 'menu',
						'type' => 'nav_menu',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => 70,
							'class' => '',
							'id' => '',
						),
						'save_format' => 'id',
						'container' => 'nav',
						'allow_null' => 0,
					),
					array(
						'key' => 'field_54506dfebf96b',
						'label' => 'Display Menu Title',
						'name' => 'display_title',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => 30,
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
					),
				),
			),
			array(
				'key' => 'field_5459b5f5ee4ab',
				'label' => 'Module Styles',
				'name' => 'module_styles',
				'type' => 'text',
				'instructions' => 'Apply CSS directly to the module container element. Use to tweak positioning/layouts to perfection.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
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

add_filter( 'acfmod/modules/menus', 'acfmod_modules_menus' );

function acfmod_modules_menus() {
	$output = '';

	$count = count( get_sub_field( 'custom_menus' ) );

	if ( have_rows( 'custom_menus' ) ):

		$output .= '<div class="custom-menus count-' . $count . '">';

			while( have_rows( 'custom_menus' ) ): the_row();
				$menu = get_sub_field( 'menu' );
				$display_title = get_sub_field( 'display_title' );
				$nav = wp_get_nav_menu_object( $menu );

				$output .= '<div class="menu-wrapper menu-' . $nav->slug . '">';

					if ( $display_title ):
						$output .= '<h3 class="menu-title">' . $nav->name . '</h3>';
					endif;

					$output .= wp_nav_menu( array(
						'echo' => false,
						'menu' => $menu,
						'menu_class' => 'menu'
					));

				$output .= '</div>';

			endwhile;

		$output .= '</div>';

	endif;

	return $output;
}
