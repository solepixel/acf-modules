<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_slider', 45 );

function acfmod_layout_slider( $layouts ) {
	$layouts[] = array(
		'key' => '543eb615cb637',
		'name' => 'slider',
		'label' => 'Slider',
		'display' => 'row',
		'sub_fields' => array(
			array(
				'key' => 'field_543eb621cb638',
				'label' => 'Slider',
				'name' => 'slider',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => apply_filters( 'acsfmod/slider/post_type', 'soliloquy' ),
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_5459b5c0ee4a7',
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

add_filter( 'acfmod/modules/slider', 'acfmod_modules_slider' );

function acfmod_modules_slider() {
	$slider = get_sub_field( 'slider' );
	$output = do_shortcode( '[slider id="' . $slider->ID . '"]' );

	return $output;
}
