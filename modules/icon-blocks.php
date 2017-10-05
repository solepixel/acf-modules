<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_icon_blocks', 40 );

function acfmod_layout_icon_blocks( $layouts ) {
	$layouts[] = array(
		'key' => '543eb572cb630',
		'name' => 'icon_blocks',
		'label' => 'Icon Blocks',
		'display' => 'row',
		'sub_fields' => array(
			array(
				'key' => 'field_5469b74ef1d78',
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
				'key' => 'field_543eb6b846edd',
				'label' => 'Icons',
				'name' => 'icons',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'min' => 1,
				'max' => 6,
				'layout' => 'row',
				'button_label' => 'Add Icon',
				'sub_fields' => array(
					array(
						'key' => 'field_543eb580cb631',
						'label' => 'Icon',
						'name' => 'icon',
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
						'preview_size' => 'thumbnail',
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
						'key' => 'field_543eb590cb632',
						'label' => 'Heading',
						'name' => 'heading',
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
						'key' => 'field_5460c8fde86b0',
						'label' => 'Heading Color',
						'name' => 'heading_color',
						'type' => 'color_picker',
						'instructions' => '(optional)',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
					),
					array(
						'key' => 'field_543eb59dcb633',
						'label' => 'Text Content',
						'name' => 'text',
						'type' => 'textarea',
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
						'maxlength' => '',
						'rows' => 4,
						'new_lines' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array(
						'key' => 'field_543eb5bfcb634',
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
						'key' => 'field_543eb5d7cb635',
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
						'key' => 'field_558a23ed3389b',
						'label' => 'Link Target',
						'name' => 'link_target',
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
							'_blank' => 'Blank (New Window)',
							'_top' => 'Top',
							'_parent' => 'Parent',
							'_self' => 'Self',
						),
						'default_value' => array(
							'' => '',
						),
						'allow_null' => 1,
						'multiple' => 0,
						'ui' => 0,
						'ajax' => 0,
						'placeholder' => '',
						'disabled' => 0,
						'readonly' => 0,
					),
					array(
						'key' => 'field_543eb5ebcb636',
						'label' => 'Call to Action Text',
						'name' => 'cta_text',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 'View Details',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
				),
			),
		),
		'min' => '',
		'max' => '',
	);

	return $layouts;
}

add_action( 'wp_enqueue_scripts', 'acfmod_register_icon_blocks_enqueues' );

function acfmod_register_icon_blocks_enqueues() {
	wp_register_style( 'acfmod-icon-blocks', ACFMOD_URI . 'assets/css/icon-blocks.min.css' );
}

add_filter( 'acfmod/modules/icon_blocks', 'acfmod_modules_icon_blocks' );

function acfmod_modules_icon_blocks() {
	$output = '';

	$css_class = trim( get_sub_field( 'css_class' ) );
	$count = count( get_sub_field( 'icons' ) );

	if ( have_rows( 'icons' ) ):
		wp_enqueue_style( 'acfmod-icon-blocks' );

		$output .= '<ul class="icon-blocks count-' . $count . ' ' . esc_attr( $css_class ) . '">';
			while( have_rows( 'icons' ) ): the_row();
				$image = get_sub_field( 'icon' );
				$link = acfmod_get_the_link();
				$target = get_sub_field( 'link_target' );
				// i don't know why, but for some reason it may return an array.
				if ( is_array( $target ) && count( $target ) > 0 )
					$target = reset( $target );
				$target = $target ? ' target="' . $target . '"' : '';

				$output .= '<li>';

					if ( $link ):
						$output .= '<a href="' . $link . '"' . $target . '>';
					endif;

					if ( $image )
						$output .= '<span class="icon" style="background-image:url(\'' . esc_attr( $image['url'] ) . '\');"></span>';

					if ( $heading = get_sub_field( 'heading' ) ):
						$heading_color = get_sub_field( 'heading_color' ) ? ' style="color:' . get_sub_field( 'heading_color' ) . ';"' : '';
						$output .= '<span class="heading"' . $heading_color . '>' . $heading . '</span>';
					endif;

					if ( $text = get_sub_field( 'text' ) ):
						$output .= '<span class="text">' . $text . '</span>';
					endif;

					if ( $cta_text = get_sub_field( 'cta_text' ) ):
						$output .= '<span class="cta">' . $cta_text . '</span>';
					endif;

					if ( $link ):
						$output .= '</a>';
					endif;
				$output .= '</li>';

			endwhile;
		$output .= '</ul>';

	endif;

	return $output;
}
