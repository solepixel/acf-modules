<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_image', 50 );

function acfmod_layout_image( $layouts ) {
	$layouts[] = array(
		'key' => '543eb643cb639',
		'name' => 'image',
		'label' => 'Image',
		'display' => 'row',
		'sub_fields' => array(
			array(
				'key' => 'field_543eb656cb63a',
				'label' => 'Source',
				'name' => 'source',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => 0,
				'min_height' => 0,
				'min_size' => 0,
				'max_width' => 0,
				'max_height' => 0,
				'max_size' => 0,
				'mime_types' => '',
			),
			array(
				'key' => 'field_54f7658a3cab1',
				'label' => 'Thumbnail Size',
				'name' => 'thumb_size',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'__full__' => 'Full Size',
					'thumbnail' => 'Thumbnail (150x150)',
					'medium' => 'Medium (300x300)',
					'large' => 'Large (1024x1024)',
					'itrade-image-module' => 'itrade-image-module (360x300)',
					'sow-carousel-default' => 'sow-carousel-default (272x182)',
				),
				'default_value' => array(
					'' => '',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array(
				'key' => 'field_54414ac1d04a9',
				'label' => 'Max Width',
				'name' => 'max_width',
				'type' => 'number',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 100,
				'placeholder' => '',
				'prepend' => '',
				'append' => '%',
				'min' => 10,
				'max' => 100,
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array(
				'key' => 'field_543ffeaa05eb9',
				'label' => 'Alignment',
				'name' => 'alignment',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'none' => 'None',
					'center' => 'Center',
					'left' => 'Left',
					'right' => 'Right',
				),
				'default_value' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array(
				'key' => 'field_54bc816c7e634',
				'label' => 'Caption',
				'name' => 'caption',
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
				'key' => 'field_543eb66dcb63b',
				'label' => 'Page Link',
				'name' => 'page_link',
				'type' => 'page_link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => array(
				),
				'allow_null' => 1,
				'multiple' => 0,
			),
			array(
				'key' => 'field_543eb680cb63c',
				'label' => 'Custom URL',
				'name' => 'custom_url',
				'type' => 'url',
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
			),
			array(
				'key' => 'field_5459b5d3ee4a8',
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

add_filter( 'acfmod/modules/image', 'acfmod_modules_image' );

function acfmod_modules_image() {
	$source = get_sub_field( 'source' );
	$alignment = get_sub_field( 'alignment' );
	$max_width = get_sub_field( 'max_width' );
	$thumb_size = get_sub_field( 'thumb_size' );
	$link = bdmod_get_the_link();
	$caption = get_sub_field( 'caption' );

	$src = $thumb_size && $thumb_size != '__full__' && isset( $source['sizes'][ $thumb_size ] ) ? $source['sizes'][ $thumb_size ] : $source['url'];

	$output = '';

	if ( $link ):
		$output .= '<a href="' . $link . '" class="image-wrap">';
	else:
		$output .= '<span class="image-wrap">';
	endif;

	$style = $max_width ? ' style="max-width:' . $max_width . '%;"' : '';

	$output .= '<img src="' . $src . '" class="align' . $alignment . '"' . $style . ' />';

	if ( $caption ):
		$output .= '<span class="image-caption">' . $caption . '</span>';
	endif;

	if ( $link ):
		$output .= '</a>';
	else:
		$output .= '</span>';
	endif;

	return $output;
}

add_filter('acf/load_field/name=thumb_size', 'bdmod_image_sizes_choices' );

function bdmod_image_sizes_choices( $field ) {

	$thumb_w = get_option( 'thumbnail_size_w' );
	$thumb_h = get_option( 'thumbnail_size_h' );

	$med_w = get_option( 'medium_size_w' );
	$med_h = get_option( 'medium_size_h' );

	$lg_w = get_option( 'large_size_w' );
	$lg_h = get_option( 'large_size_h' );

    $field['choices'] = array(
    	'__full__' => __( 'Full Size', 'bdmod' ),
    	'thumbnail' => __( 'Thumbnail', 'bdmod' ) . ' (' . $thumb_w . 'x' . $thumb_h . ')',
    	'medium' => __( 'Medium', 'bdmod' ) . ' (' . $med_w . 'x' . $med_h . ')',
    	'large' => __( 'Large', 'bdmod' ) . ' (' . $lg_w . 'x' . $lg_h . ')'
    );

    global $_wp_additional_image_sizes;

    if ( is_array( $_wp_additional_image_sizes ) ) {

        foreach( $_wp_additional_image_sizes as $name => $size ) {

            $field['choices'][ $name ] = $name . ' (' . $size['width'] . 'x' . $size['height'] . ')';

        }

    }

    return $field;
}
