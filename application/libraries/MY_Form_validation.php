<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Class MY_Form_validation
 */
class MY_Form_validation extends CI_Form_validation {

	public function __construct() {
		parent::__construct();
		$this->_error_prefix = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		$this->_error_suffix = '</div>';
	}

	/**
	 * Get css class
	 * Gets the html property class name
	 * @access public
	 * @param string the field name
	 * @param string the css class name
	 * @return void
	 */
	public function error_css_class($field = '', $css_class = 'has-error') {
		if (!isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return '';
		}

		return $css_class;
	}

}
