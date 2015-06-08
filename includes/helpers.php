<?php

global $acfmod_sections, $acfmod_section_open;

function acfmod_get_the_link( $prefix = '' ){
	return get_sub_field( $prefix . 'custom_url' ) ? get_sub_field( $prefix . 'custom_url' ) : get_sub_field( $prefix . 'page_link' );
}

add_action( 'wp_ajax_acfmod_get_post_content', 'acfmod_get_post_content' );
add_action( 'wp_ajax_nopriv_acfmod_get_post_content', 'acfmod_get_post_content' );

function acfmod_get_post_content( $post_id = '', $filtered = true ){
	$doing_ajax = defined( 'DOING_AJAX' ) && DOING_AJAX;

	if( ! $post_id )
		$post_id = isset( $_GET['id'] ) ? (int) sanitize_text_field( $_GET['id'] ) : $post_id;

	$response = array(
		'success' => false
	);

	if( ! $post_id ){
		if( $doing_ajax )
			wp_send_json( $response );
		return false;
	}

	$the_post = get_post( $post_id );

	if( ! $doing_ajax ){
		if( $filtered )
			return apply_filters( 'the_content', $the_post->post_content );
		return $the_post->post_content;
	}

	$response['post_content'] = apply_filters( 'the_content', $the_post->post_content );
	$response['success'] = true;

	wp_send_json( $response );
}

function acfmod_js_vars(){
	return array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	);
}

function acfmod_get_post_image( $post_id = NULL, $default = false ){
	if( ! $post_id )
		$post_id = get_the_ID();

	$image = get_field( '_acfmod_image', $post_id );

	if( ! $image && $default )
		return $default;

	if( ! $image )
		$image = get_field( '_acfmod_default_post_image', 'option' );


	return $image;
}
