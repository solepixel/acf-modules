<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_gravity_form', 75 );

function acfmod_layout_gravity_form( $layouts ) {
	if ( ! class_exists( 'GFForms' ) )
		return $layouts;

	$layouts[] = array(
		'key' => '54665a37a7c21',
		'name' => 'gravity_form',
		'label' => 'Gravity Form',
		'display' => 'row',
		'sub_fields' => array(
			array(
				'key' => 'field_54665a45a7c22',
				'label' => 'Select Form',
				'name' => 'form',
				'type' => 'gravity_forms_field',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'allow_null' => 0,
				'allow_multiple' => 1,
				'multiple' => 0,
			),
			array(
				'key' => 'field_5481db4801885',
				'label' => 'Display Title?',
				'name' => 'title',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
			),
			array(
				'key' => 'field_5481db6601886',
				'label' => 'Display Description?',
				'name' => 'description',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
			),
			array(
				'key' => 'field_5481db8101887',
				'label' => 'Use AJAX?',
				'name' => 'ajax',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
			),
			array(
				'key' => 'field_5481dbb901888',
				'label' => 'Tab Index',
				'name' => 'tabindex',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 20,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		'min' => '',
		'max' => '',
	);

	return $layouts;
}

add_filter( 'acfmod/modules/gravity_form', 'acfmod_modules_gravity_form' );

function acfmod_modules_gravity_form() {
	$output = '';

	if ( ! function_exists( 'gravity_form' ) )
		return $output;

	$form = get_sub_field( 'form' );
	$title = get_sub_field( 'title' );
	$description = get_sub_field( 'description' );
	$ajax = get_sub_field( 'ajax' );
	$tabindex = get_sub_field( 'tabindex' );

	if ( ! $tabindex )
		$tabindex = 20;

	if ( $form )
		$output = gravity_form( $form->id, $title, $description, false, array(), $ajax, $tabindex, false );

	return $output;
}
