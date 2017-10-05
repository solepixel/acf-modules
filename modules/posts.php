<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_posts', 55 );

function acfmod_layout_posts( $layouts ) {
	$layouts[] = array(
		'key' => '543ebbc2231a8',
		'name' => 'posts',
		'label' => 'Posts',
		'display' => 'row',
		'sub_fields' => array(
			array(
				'key' => 'field_543ebbcc231a9',
				'label' => 'Post Type',
				'name' => 'post_type',
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
					'post' => 'Posts',
					'page' => 'Pages',
					'safecss' => 'Custom CSS',
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
				'key' => 'field_543ebc32231aa',
				'label' => 'Number of Items',
				'name' => 'limit',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 4,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array(
				'key' => 'field_5464d11be4051',
				'label' => 'Post Categories',
				'name' => 'categories',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'category',
				'field_type' => 'multi_select',
				'allow_null' => 1,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
				'add_term' => 1,
			),
			array(
				'key' => 'field_5464d17ee4052',
				'label' => 'Post Tags',
				'name' => 'tags',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'post_tag',
				'field_type' => 'multi_select',
				'allow_null' => 1,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
				'add_term' => 1,
			),
			array(
				'key' => 'field_544259ad54d37',
				'label' => 'Placeholder Image',
				'name' => 'placeholder',
				'type' => 'image',
				'instructions' => 'Image to be used if posts do not have an image.',
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
				'key' => 'field_5449d2b639de2',
				'label' => 'Display Options',
				'name' => 'display_options',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'post_title' => 'Post Title',
					'post_image' => 'Post Image',
					'post_date' => 'Post Date',
					'post_excerpt' => 'Post Excerpt',
				),
				'default_value' => array(
					'post_title' => 'post_title',
					'post_image' => 'post_image',
					'post_date' => 'post_date',
					'post_excerpt' => 'post_excerpt',
				),
				'layout' => 'horizontal',
			),
		),
		'min' => '',
		'max' => '',
	);

	return $layouts;
}

add_filter( 'acfmod/modules/posts', 'acfmod_modules_posts' );

function acfmod_modules_posts() {
	$placeholder = get_sub_field( 'placeholder' );
	$display_options = get_sub_field( 'display_options' );
	$categories = get_sub_field( 'categories' );
	$tags = get_sub_field( 'tags' );
	$output = '';

	$args = array(
		'post_type' => get_sub_field( 'post_type' ),
		'posts_per_page' => get_sub_field( 'limit' )
	);

	if ( $categories )
		$args['category__in'] = $categories;

	if ( $tags )
		$args['tag__in'] = $tags;


	$results = new WP_Query( $args );

	if ( ! is_array( $display_options ) ) {
		$display_options = array();
	}

	if ( $results->have_posts() ):
		$output .= '<ul>';
			$i = 1;
			while( $results->have_posts() ): $results->the_post();
				if ( $image = acfmod_get_post_image() )
					$image = $image['url'];
				if ( ! $image && function_exists( 'get_the_image' ) ) {
					if ( $image = get_the_image( array( 'echo' => false, 'format' => 'array' ) ) )
						$image = $image['url'];
				}
				if ( ! $image && $placeholder )
					$image = $placeholder['url'];

				$nth = 'first';
				if ( $i % 4 == 2 ) {
					$nth = 'second';
				} elseif ( $i % 4 == 3 ) {
					$nth = 'third';
				} elseif ( $i % 4 == 0 ) {
					$nth = 'fourth';
				}

				$output .= '<li class="' . $nth . '-entry">';
					if ( $image && in_array( 'post_image', $display_options ) ):
						$output .= '<a href="' . get_permalink() . '" class="post-image">
							<span class="read-more">' . __( 'Read More', 'acfmod' ) . '</span>
							<img src="' . $image . '" />
						</a>';
					endif;

					if ( in_array( 'post_title', $display_options ) )
						$output .= '<span class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></span>';

					if ( in_array( 'post_date', $display_options ) )
						$output .= '<span class="post-date">' . get_the_date( 'F j, Y' ) . '</span>';

					if ( in_array( 'post_excerpt', $display_options ) )
						$output .= '<span class="post-excerpt">' . get_the_excerpt() . '</span>';
				$output .= '</li>';

				$i++;
			endwhile;
		$output .= '</ul>';
		wp_reset_postdata();
	endif;

	return $output;
}
