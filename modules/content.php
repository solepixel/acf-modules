<?php
/**
 * Simple Content ACF Module
 *
 * @package acf-modules
 */

add_filter( 'acfmod/layouts', 'acfmod_layout_simple_content', 30 );

/**
 * Simple Content Layout
 *
 * @param array $layouts  Content Layout Field Array.
 * @return array          Layouts, now with Simple Content
 */
function acfmod_layout_simple_content( $layouts ) {

	$subfields = array(
		array(
			'key' => 'field_543eb52ccb62f',
			'label' => 'Simple Content',
			'name' => 'content',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
	);

	$post_id = isset( $_GET['post'] ) ? absint( sanitize_text_field( $_GET['post'] ) ) : '';

	if ( ! empty( $post_id ) ) {

		if ( is_admin() ) {
			wp_register_script( 'acfmod-simple-content-admin', ACFMOD_URI . 'assets/js/simple-content.admin.js', array( 'jquery' ) );
			wp_localize_script( 'acfmod-simple-content-admin', 'acfmod_vars', acfmod_js_vars() );
			wp_enqueue_script( 'acfmod-simple-content-admin' );
		}

		if ( acfmod_get_post_content( $post_id, false ) ) {
			$subfields[] = array(
				'key' => 'field_55686bd79d811',
				'label' => 'Load Post Content',
				'name' => 'load_post_content',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'Import content from current post_content field.',
				'default_value' => 0,
			);

			$subfields[] = array(
				'key' => 'field_55686c1d9d812',
				'label' => 'Delete Post Content',
				'name' => 'delete_post_content',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_55686bd79d811',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'Delete original post content after saving.',
				'default_value' => 0,
			);
		}
	}

	$subfields[] = array(
		'key' => 'field_5459b579ee4a6',
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
	);

	$layouts[] = array(
		'key' => '543eb4f3a8e09',
		'name' => 'simple_content',
		'label' => 'Simple Content',
		'display' => 'row',
		'sub_fields' => $subfields,
		'min' => '',
		'max' => '',
	);

	return $layouts;
}

add_filter( 'acfmod/modules/content', 'acfmod_modules_content' );
add_filter( 'acfmod/modules/simple_content', 'acfmod_modules_content' );

/**
 * Simple Content Module
 *
 * @return html  Module Output
 */
function acfmod_modules_content() {
	$output = get_sub_field( 'content' );
	return $output;
}

add_action( 'acf/save_post', 'acfmod_simple_content_save_post', 20 );

/**
 * This may delete the post content if checkbox is selected
 *
 * @param int $post_id  The Post ID.
 */
function acfmod_simple_content_save_post( $post_id ) {

	// bail early if no ACF data.
	if ( empty( $_POST['acf'] ) ) {
		return;
	}

	// array of field values.
	$fields = wp_unslash( $_POST['acf'] );

	if ( ! isset( $fields['acf_modules_field'] ) && is_array( $fields['acf_modules_field'] ) ) {
		return;
	}

	// This may change in the future... yikes...
	$delete_content_key = 'field_55686c1d9d812';

	// assume we aren't deleting content.
	$do_delete_content = false;

	// get modules values.
	foreach ( $fields['acf_modules_field'] as $module ) {
		if ( isset( $module[ $delete_content_key ] ) ) {
			if ( $module[ $delete_content_key ] ) {
				$do_delete_content = true;
			}
		}
	}

	// don't store the values for delete and load content fields.
	// @TODO: not sure how to do that just yet.
	// bail early if we're not deleting the content.
	if ( ! $do_delete_content ) {
		return;
	}

	// clear the post content.
	remove_action( 'acf/save_post', 'acfmod_simple_content_save_post', 20 );

	$delete_content = array(
		'ID' => $post_id,
		'post_content' => '',
	);

	wp_update_post( $delete_content );

	add_action( 'acf/save_post', 'acfmod_simple_content_save_post', 20 );
}
