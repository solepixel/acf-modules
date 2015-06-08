<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_call_to_action', 65 );

function acfmod_layout_call_to_action( $layouts ){
	$layouts[] = array (
		'key' => '5449d44b4e176',
		'name' => 'call_to_action',
		'label' => 'Call to Action',
		'display' => 'row',
		'sub_fields' => array (
			array (
				'key' => 'field_544ea6d6b0b93',
				'label' => 'Alignment',
				'name' => 'alignment',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'left' => 'Left',
					'center' => 'Center (default)',
					'right' => 'Right',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'center',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5449d46b4e177',
				'label' => 'Heading',
				'name' => 'heading',
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
			array (
				'key' => 'field_5449d48a4e178',
				'label' => 'Text',
				'name' => 'text',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'basic',
				'media_upload' => 1,
			),
			array (
				'key' => 'field_5449d4ad4e179',
				'label' => 'Button Text',
				'name' => 'button_text',
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
			array (
				'key' => 'field_5449d4bc4e17a',
				'label' => 'CTA URL',
				'name' => 'cta_url',
				'type' => 'url',
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
			),
			array (
				'key' => 'field_5449d4d24e17b',
				'label' => 'Background Color',
				'name' => 'background_color',
				'type' => 'color_picker',
				'instructions' => 'Suggested Hex codes are: #3BB6E1 (blue), #BBD152 (green), and #EC7326 (orange)',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
			),
			array (
				'key' => 'field_5449d4f14e17c',
				'label' => 'Text Color',
				'name' => 'text_color',
				'type' => 'color_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#333333',
			),
			array (
				'key' => 'field_5449d5054e17d',
				'label' => 'Button Color',
				'name' => 'button_color',
				'type' => 'color_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#3BB6E1',
			),
			array (
				'key' => 'field_5459b5ecee4aa',
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

global $cta_modules;
$cta_modules = 0;

add_filter( 'acfmod/modules/call_to_action', 'acfmod_modules_call_to_action' );

function acfmod_modules_call_to_action(){
	global $cta_modules;
	$cta_modules++;
	$heading = trim( get_sub_field( 'heading' ) );
	$text = trim( get_sub_field( 'text' ) );
	$button = trim( get_sub_field( 'button_text' ) );
	$alignment = get_sub_field( 'alignment' );

	$url = get_sub_field( 'cta_url' );
	$background = get_sub_field( 'background_color' );
	$foreground = get_sub_field( 'text_color' );
	$button_color = get_sub_field( 'button_color' );

	$output = '<style>.cta-' . $cta_modules . ' {';

		if( $background )
			$output .= 'background-color: ' . $background . ';';
		if( $foreground )
			$output .= 'color: ' . $foreground . ';';
		if( $alignment )
			$output .= 'text-align: ' . $alignment . ';';

	$output .= '} .cta-' . $cta_modules . ' .cta-heading, .cta-' . $cta_modules . ' .cta-text {';
		if( $foreground )
			$output .= 'color:' . $foreground . ';';
	$output .= '} .cta-' . $cta_modules . ' .cta {';
		if( $button_color ){
			$output .= 'border-color:' . $button_color . ';';
			$output .= 'color:' . $button_color . ';';
		}
	$output .= '}</style>';

	$output .= '<div class="call-to-action cta-' . $cta_modules . '">';
		if( $heading )
			$output .= '<h3 class="cta-heading">' . $heading . '</h3>';
		if( $text )
			$output .= '<div class="cta-text">' . $text . '</div>';
		if( $button && $url )
			$output .= '<a class="cta" href="' . esc_attr( $url ) . '">' . $button . '</a>';
	$output .= '</div>';


	return $output;
}
