<?php
/**
 * Site-Search ACF Module
 *
 * @package acf-modules
 */

add_filter( 'acfmod/layouts', 'acfmod_layout_site_search', 85 );

/**
 * Site Search Layout
 *
 * @param array $layouts  Layouts Field Array.
 * @return array          Layouts, now with Site Search
 */
function acfmod_layout_site_search( $layouts ) {
	$layouts[] = array(
		'key' => '54bc8ce7073a1',
		'name' => 'site_search',
		'label' => 'Site Search',
		'display' => 'row',
		'sub_fields' => array(
			array(
				'key' => 'field_54bc8cf7073a2',
				'label' => 'Search Label',
				'name' => 'search_label',
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
				'key' => 'field_54bfc3bcfb35f',
				'label' => 'Search URL',
				'name' => 'search_url',
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
				'key' => 'field_54bfc3cafb360',
				'label' => 'Method',
				'name' => 'method',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'get' => 'GET',
					'post' => 'POST',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'get',
				'layout' => 'vertical',
			),
			array(
				'key' => 'field_54bfc44500dcf',
				'label' => 'Input Name',
				'name' => 'input_name',
				'type' => 'text',
				'instructions' => 'This is the name of the text input for the search',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 's',
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

add_filter( 'acfmod/modules/site_search', 'acfmod_modules_site_search' );

/**
 * Site Search Module
 *
 * @return html  Module Output
 */
function acfmod_modules_site_search() {
	$label = get_sub_field( 'search_label' );
	$action = get_sub_field( 'search_url' ) ? get_sub_field( 'search_url' ) : '/';
	$method = get_sub_field( 'method' ) ? get_sub_field( 'method' ) : 'get';
	$input_name = get_sub_field( 'input_name' ) ? get_sub_field( 'input_name' ) : 's';

	$output = '<form action="' . esc_attr( $action ) . '" method="' . esc_attr( $method ) . '" class="super-search">';
		$output .= '<label><span class="placeholder">' . esc_html( $label ) . '</span><input type="search" name="' . esc_attr( $input_name ) . '" /></label>';
		$output .= '<input type="submit" value="Search" />';
	$output .= '</form>';

	return $output;
}

