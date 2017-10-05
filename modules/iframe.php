<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_iframe', 42 );

function acfmod_layout_iframe( $layouts ) {

	$layouts[] = array(
		'key' => '5569b8d6d0990',
		'name' => 'iframe',
		'label' => 'Iframe',
		'display' => 'block',
		'sub_fields' => array(
			array(
				'key' => 'field_5569b8f3f0d71',
				'label' => 'Iframe URL',
				'name' => 'url',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'http://',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array(
				'key' => 'field_556a5c009bee8',
				'label' => 'Iframe Height',
				'name' => 'height',
				'type' => 'number',
				'instructions' => '',
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
				'append' => 'px',
				'min' => '',
				'max' => '',
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array(
				'key' => 'field_5569b94ef0d72',
				'label' => 'CSS Class',
				'name' => 'css_class',
				'type' => 'text',
				'instructions' => '',
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
			array(
				'key' => 'field_5569b983f0d73',
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

add_filter( 'acfmod/modules/iframe', 'acfmod_modules_iframe' );

function acfmod_modules_iframe() {
	$url = trim( get_sub_field( 'url' ) );
	$css_class = trim( get_sub_field( 'css_class' ) );
	$height = trim( get_sub_field( 'height' ) );

	$output = '<iframe class="acfmod-iframe ' . $css_class . '"';
		$output .= ' src="' . esc_attr( $url ) . '" ';
		if ( $height )
			$output .= 'height="' . $height . '" ';
		$output .= apply_filters( 'acfmod/iframe/attributes', 'allowtransparency="true" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" oallowfullscreen="oallowfullscreen" msallowfullscreen="msallowfullscreen"' );
	$output .= '></iframe>';

	return $output;
}
