<?php

add_filter( 'acfmod/layouts', 'acfmod_layout_counters', 60 );

function acfmod_layout_counters( $layouts ) {
	$layouts[] = array(
		'key' => '54490f40a6662',
		'name' => 'counters',
		'label' => 'Stats/Counters',
		'display' => 'row',
		'sub_fields' => array(
			array(
				'key' => 'field_54490f59a6663',
				'label' => 'Style',
				'name' => 'style',
				'type' => 'radio',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'plain' => 'Plain',
					'bar' => 'Bar',
					'circle' => 'Circle',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'plain',
				'layout' => 'horizontal',
			),
			array(
				'key' => 'field_54523d7aef7eb',
				'label' => 'Disable Bar Background',
				'name' => 'disable_bar_background',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_54490f59a6663',
							'operator' => '==',
							'value' => 'bar',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
			),
			array(
				'key' => 'field_54490fb5a6664',
				'label' => 'Stats',
				'name' => 'stats',
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
				'max' => '',
				'layout' => 'row',
				'button_label' => 'Add Stat',
				'sub_fields' => array(
					array(
						'key' => 'field_54490ff1a6665',
						'label' => 'Value',
						'name' => 'value',
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
						'key' => 'field_5449105ca6666',
						'label' => 'Label',
						'name' => 'label',
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
						'key' => 'field_54491082a6667',
						'label' => 'Color',
						'name' => 'color',
						'type' => 'color_picker',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '#333333',
					),
					array(
						'key' => 'field_5450fbbd85fa7',
						'label' => 'Disable Text Color',
						'name' => 'disable_text_color',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_54490f59a6663',
									'operator' => '==',
									'value' => 'circle',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
					),
				),
			),
			array(
				'key' => 'field_544ea678eee76',
				'label' => 'Direction',
				'name' => 'direction',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_54490f59a6663',
							'operator' => '==',
							'value' => 'bar',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'right' => 'Right (default)',
					'left' => 'Left',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'right',
				'layout' => 'horizontal',
			),
			array(
				'key' => 'field_544e64202d6b3',
				'label' => 'Style Restrictions',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_54490f59a6663',
							'operator' => '==',
							'value' => 'bar',
						),
					),
					array(
						array(
							'field' => 'field_54490f59a6663',
							'operator' => '==',
							'value' => 'circle',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'Note: This field style only supports percentage based values (0-100). Percent sign (%) is optional.',
				'esc_html' => 0,
			),
			array(
				'key' => 'field_5459b5e0ee4a9',
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

add_filter( 'acfmod/modules/counters', 'acfmod_modules_counters' );

global $acfmod_counters;
$acfmod_counters = 0;

function acfmod_modules_counters() {
	$style = get_sub_field( 'style' );
	$direction = get_sub_field( 'direction' );
	$attribute = 'color';

	if ( $style == 'bar' ) {
		wp_enqueue_script( 'waypoints' );
		$attribute = 'background-color';
	} else {
		wp_enqueue_script( 'jquery-counterup' );
	}
	if ( $style != 'plain' ) {
		wp_enqueue_script( 'jquery-easypiechart' );
	}

	$output = '';

	if ( have_rows( 'stats' ) ):

		global $acfmod_counters;
		$output .= '<ul class="stats ' . $style . '">';
			$largest = 0;
			while( have_rows( 'stats' ) ): the_row();
				$value = str_replace( array( ',', '%' ), '', get_sub_field( 'value' ) );
				if ( $value > $largest )
					$largest = $value;
			endwhile;

			while( have_rows( 'stats' ) ): the_row();
				$acfmod_counters++;
				$value = get_sub_field( 'value' );
				$label = get_sub_field( 'label' );
				$color = get_sub_field( 'color' );
				$disable_text_color = get_sub_field( 'disable_text_color' );
				$disable_bar_background = get_sub_field( 'disable_bar_background' );
				$extra = '';
				$css = '';
				$wrap_start = '';

				$number_value = str_replace( array( ',', '%' ), '', $value );
				if ( $largest > 100 ) {
					$number_value = ( $number_value / $largest ) * 100;
				}

				if ( $style == 'bar' ) {
					$small = $number_value <= 5 ? ' small' : '';
					$wrap_start = '<span class="progress' . $small . '" style="width:' . $number_value . '%;';
					if ( ! $disable_bar_background )
						$wrap_start .= 'background-color:' . $color . ';';
					$wrap_start .= '">';
					$extra = '</span>';
					if ( $small ) {
						$css = ' style="color:'. $color . ';"';
					}
				} else {
					if ( ! $disable_text_color )
						$css = ' style="color:' . $color . ';"';
					if ( strpos( $value, '%' ) ) {
						$value = str_replace( '%', '', $value );
						$extra = '%';
					}
				}

				$direction = $direction == 'left' ? ' dir-left' : '';
				$label = '<span class="label">' . $label . '</span>';

				$output .= '<li class="counter-' . $acfmod_counters . $direction . '">';
					if ( $style == 'bar' )
						$output .= $label;

					$output .= '<h3 class="value" data-percent="' . esc_attr( $number_value ) . '" data-bar-color="' . esc_attr( $color ) . '"' . $css . '>' . $wrap_start . '<span class="data"><span class="counterup">' . $value . '</span>' . $extra . '</span></h3>';

					if ( $style != 'bar' )
						$output .= $label;

				$output .= '</li>';
			endwhile;
		$output .= '</ul>';

	endif;

	return $output;
}
