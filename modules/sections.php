<?php

// Add section opener and closer

add_filter( 'acfmod/layouts', 'acfmod_layout_section_opener', 200 );

function acfmod_layout_section_opener( $layouts ){
	$layouts[] = array (
		'key' => '5442a3ba54f67',
		'name' => 'section',
		'label' => 'Section Opener',
		'display' => 'row',
		'sub_fields' => array (
			array (
				'key' => 'field_5442a3c954f68',
				'label' => 'Class',
				'name' => 'section_class',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'light-gray' => 'Light Gray',
					'medium-gray' => 'Medium Gray',
					'dark-gray' => 'Dark Gray',
					'two-column' => 'Two Column',
					'three-column' => 'Three Column',
					'four-column' => 'Four Column',
				),
				'default_value' => array (
				),
				'allow_null' => 1,
				'multiple' => 1,
				'ui' => 1,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_5451a71c9b3b3',
				'label' => 'Custom Class',
				'name' => 'custom_class',
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
				'key' => 'field_544e6b7557a78',
				'label' => 'Close previous section?',
				'name' => 'close_previous_section',
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
					1 => 'Yes',
					0 => 'No',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5450697b1cded',
				'label' => 'Column 1 Width',
				'name' => 'col_1',
				'type' => 'number',
				'instructions' => 'If left empty, defaults are set to equal width columns ',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_5442a3c954f68',
							'operator' => '==',
							'value' => 'two-column',
						),
					),
					array (
						array (
							'field' => 'field_5442a3c954f68',
							'operator' => '==',
							'value' => 'three-column',
						),
					),
					array (
						array (
							'field' => 'field_5442a3c954f68',
							'operator' => '==',
							'value' => 'four-column',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '%',
				'min' => 1,
				'max' => 100,
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_54506a171cdf0',
				'label' => 'Column 2 Width',
				'name' => 'col_2',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_5442a3c954f68',
							'operator' => '==',
							'value' => 'two-column',
						),
					),
					array (
						array (
							'field' => 'field_5442a3c954f68',
							'operator' => '==',
							'value' => 'three-column',
						),
					),
					array (
						array (
							'field' => 'field_5442a3c954f68',
							'operator' => '==',
							'value' => 'four-column',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '%',
				'min' => 1,
				'max' => 100,
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_54506a3c1cdf1',
				'label' => 'Column 3 Width',
				'name' => 'col_3',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_5442a3c954f68',
							'operator' => '==',
							'value' => 'three-column',
						),
					),
					array (
						array (
							'field' => 'field_5442a3c954f68',
							'operator' => '==',
							'value' => 'four-column',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '%',
				'min' => 1,
				'max' => 100,
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_54506a621cdf2',
				'label' => 'Column 4 Width',
				'name' => 'col_4',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_5442a3c954f68',
							'operator' => '==',
							'value' => 'four-column',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '%',
				'min' => 1,
				'max' => 100,
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

add_filter( 'acfmod/layouts', 'acfmod_layout_section_closer', 201 );

function acfmod_layout_section_closer( $layouts ){
	$layouts[] = array (
		'key' => '5442a42254f69',
		'name' => 'section_closer',
		'label' => 'Section Closer',
		'display' => 'row',
		'sub_fields' => array (
			array (
				'key' => 'field_5442a43e54f6a',
				'label' => 'Closing Element',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'This will close the previous Section.',
				'esc_html' => 0,
			),
		),
		'min' => '',
		'max' => '',
	);

	return $layouts;
}


add_action( 'wp_enqueue_scripts', 'acfmod_register_section_enqueues' );

function acfmod_register_section_enqueues(){
	wp_register_style( 'acfmod-sections', ACFMOD_URI . 'assets/css/sections.min.css' );
}


function acfmod_open_section( $content = '' ){

	wp_enqueue_style( 'acfmod-sections' );

	global $acfmod_sections, $acfmod_current_section;

	$class = get_sub_field( 'section_class' );

	if( ! is_array( $class ) )
		$class = $class ? array( $class ) : array();

	if( $custom_class = get_sub_field( 'custom_class' ) )
		$class[] = $custom_class;

	if( count( $class ) )
		$class = ' ' . implode( ' ', $class );
	else
		$class = '';

	$section = new ACFMOD_Section();
	$section->set_class( $class );

	for( $i = 1; $i <= 4; $i++ ){
		$section->set_col_width( $i, get_sub_field( 'col_' . $i ) );
	}

	// append the content
	$content .= $section->open();

	// instantiate current section, or increase by one
	if( ! $acfmod_current_section && $acfmod_current_section !== 0 )
		$acfmod_current_section = 0;
	else
		$acfmod_current_section++;

	// hard code the index to avoid potential issues.
	$acfmod_sections[ $acfmod_current_section ] = $section;

	return $content;
}

function acfmod_close_section( $content = '' ){
	global $acfmod_sections, $acfmod_current_section;

	if( ! count( $acfmod_sections ) )
		return $content;

	if( isset( $acfmod_sections[ $acfmod_current_section ] ) && $acfmod_sections[ $acfmod_current_section ]->is_open() ){
		$content .= $acfmod_sections[ $acfmod_current_section ]->close();
		unset( $acfmod_sections[ $acfmod_current_section ] );
		$acfmod_current_section--;
	}

	return $content;
}

function acfmod_close_sections( $content = '' ){
	global $acfmod_sections;

	# close any sections still open
	if( count( $acfmod_sections ) ):
		foreach( $acfmod_sections as $key => $section ):
			$content .= acfmod_close_section();
		endforeach;
	endif;

	return $content;
}

class ACFMOD_Section {

	var $open = true;

	var $class = '';

	var $current_col = 0;

	public function is_open(){
		return $this->open;
	}

	public function get_col_width( $col = NULL ){
		if( $col === NULL )
			$col = $this->current_col;

		if( isset( $this->{'col' . $col . 'width'} ) ){
			return $this->{'col' . $col . 'width'};
		}

		return false;
	}

	public function set_col_width( $col, $width ){
		$this->{'col' . $col . 'width'} = $width;
	}

	public function set_class( $class ){
		$this->class = $class;
	}

	public function get_class(){
		if( $this->class )
			$this->class = ' ' . trim( $this->class );
		return $this->class;
	}

	function get_id(){
		global $acfmod_current_section;
		return $acfmod_current_section;
	}

	public function open(){
		global $acfmod_sections, $acfmod_current_section;

		$markup = '';
		$section_open = false;

		if( isset( $acfmod_sections[ $acfmod_current_section ] ) ){
			$acfmod_sections[ $acfmod_current_section ]->current_col++;
			$col_width = $acfmod_sections[ $acfmod_current_section ]->get_col_width();
			$section_open = $acfmod_sections[ $acfmod_current_section ]->is_open();

			$id = $acfmod_sections[ $acfmod_current_section ]->get_id();

			$this->class .= ' section-column';
			$this->class .= ' section-' . $id;

			$markup .= '<style type="text/css">';
				$markup .= '.section.section-' . $id . ',.section.two-column>.section.section-' . $id . ',.section.three-column>.section.section-' . $id . ',.section.four-column>.section.section-' . $id . ' {';
					$markup .= 'width: ' . $col_width . '%;';
				$markup .= '}';
			$markup .= '</style>';
		}

		$markup .= "\r\n" . '<div class="section' . $this->get_class() . '">';

		if( ! $section_open )
			if( function_exists( 'genesis_structural_wrap' ) )
				$markup .= genesis_structural_wrap( 'modular-section', 'open', false );

		$this->open = true;

		return $markup;
	}

	public function close(){
		global $acfmod_sections, $acfmod_current_section;

		$markup = '';

		if( isset( $acfmod_sections[ $acfmod_current_section ] ) )
			$section_open = $acfmod_sections[ $acfmod_current_section ]->is_open();

		if( ! $section_open )
			if( function_exists( 'genesis_structural_wrap' ) )
				$markup = genesis_structural_wrap( 'modular-section', 'close', false );

		$markup .= '</div><!-- .section ' . $this->get_class() . ' -->' . "\r\n";

		$this->open = false;

		return $markup;
	}
}
