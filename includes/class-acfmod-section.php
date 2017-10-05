<?php
/**
 * ACFMod Section Class
 *
 * @package acf-modules
 */

/**
 * Class Declaration of ACFMOD_Section
 */
class ACFMOD_Section {

	/**
	 * Is section open?
	 *
	 * @var boolean
	 */
	var $open = true;

	/**
	 * Section Class
	 *
	 * @var string
	 */
	var $class = '';

	/**
	 * Current Column
	 *
	 * @var integer
	 */
	var $current_col = 0;

	/**
	 * Is section open?
	 *
	 * @return boolean  If open or not
	 */
	public function is_open() {
		return $this->open;
	}

	/**
	 * Get Column Width
	 *
	 * @param string $col  Which column.
	 * @return mixed       Column width
	 */
	public function get_col_width( $col = null ) {
		if ( null === $col ) {
			$col = $this->current_col;
		}

		if ( isset( $this->{'col' . $col . 'width'} ) ) {
			return $this->{'col' . $col . 'width'};
		}

		return false;
	}

	/**
	 * Set Column Width
	 *
	 * @param string $col    Which column.
	 * @param int    $width  Width of Column.
	 */
	public function set_col_width( $col, $width ) {
		$this->{'col' . $col . 'width'} = $width;
	}

	/**
	 * Set Class of Section
	 *
	 * @param string $class  Class Name.
	 */
	public function set_class( $class ) {
		$this->class = $class;
	}

	/**
	 * Get Section Class
	 *
	 * @return string  Class Name
	 */
	public function get_class() {
		if ( $this->class ) {
			$this->class = ' ' . trim( $this->class );
		}
		return $this->class;
	}

	/**
	 * Get Section ID
	 *
	 * @return string  Section ID
	 */
	function get_id() {
		global $acfmod_current_section;
		return $acfmod_current_section;
	}

	/**
	 * Open Section
	 *
	 * @return string  HTML Markup to open section
	 */
	public function open() {
		global $acfmod_sections, $acfmod_current_section;

		$markup = '';
		$section_open = false;

		if ( isset( $acfmod_sections[ $acfmod_current_section ] ) ) {
			$acfmod_sections[ $acfmod_current_section ]->current_col++;
			$col_width = $acfmod_sections[ $acfmod_current_section ]->get_col_width();
			$section_open = $acfmod_sections[ $acfmod_current_section ]->is_open();

			$id = $acfmod_sections[ $acfmod_current_section ]->get_id();

			$this->class .= ' section-column';
			$this->class .= ' section-' . $id;

			$markup .= '<style type="text/css">';
				$markup .= '.section.section-' . esc_html( $id ) . ',.section.two-column>.section.section-' . esc_html( $id ) . ',.section.three-column>.section.section-' . esc_html( $id ) . ',.section.four-column>.section.section-' . esc_html( $id ) . ' {';
					$markup .= 'width: ' . esc_html( $col_width ) . '%;';
				$markup .= '}';
			$markup .= '</style>';
		}

		$markup .= "\r\n" . '<div class="section' . esc_attr( $this->get_class() ) . '">';

		if ( ! $section_open ) {
			if ( function_exists( 'genesis_structural_wrap' ) ) {
				$markup .= genesis_structural_wrap( 'modular-section', 'open', false );
			}
		}

		$this->open = true;

		return $markup;
	}

	/**
	 * Close Section
	 *
	 * @return string  HTML Markup to close section
	 */
	public function close() {
		global $acfmod_sections, $acfmod_current_section;

		$markup = '';

		if ( isset( $acfmod_sections[ $acfmod_current_section ] ) ) {
			$section_open = $acfmod_sections[ $acfmod_current_section ]->is_open();
		}

		if ( ! $section_open ) {
			if ( function_exists( 'genesis_structural_wrap' ) ) {
				$markup = genesis_structural_wrap( 'modular-section', 'close', false );
			}
		}

		$markup .= '</div><!-- .section ' . esc_html( $this->get_class() ) . ' -->' . "\r\n";

		$this->open = false;

		return $markup;
	}
}
