<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('bmsform_input')) {

	/**
	 * Return the bootstrap html block for input tag
	 * @param string $data
	 * @param string $label
	 * @param string/array $value
	 * @param boolean $required
	 * @param string $attributes
	 * @param string $type
	 * @param boolean $check
	 * @param string $hint
	 * @return string
	 */
	function bmsform_input($data = '', $label = '', $value = '', $required = false, $attributes = '', $type = 'text', $check = false, $hint = '', $addon = '') {
		$input = '<div class="form-group ' . ($required ? bmsform_error($data) : '') . '">';
		if (!empty($label)) {
			$input .= form_label($label . ($required ? ' <span class="required">*</span>' : ''), $data, array('class' => 'col-sm-3 control-label no-padding-right'));
		}
		$input .= '<div class="' . (empty($label) ? 'col-sm-12' : 'col-sm-9') . '">';
		if (!empty($addon)) {
			$input .= '<div class="input-group col-sm-5" style="margin-bottom: 10px;">';
		}
		$extra = 'id="' . $data . '"' . (empty($attributes) ? 'class="col-xs-10 col-sm-5" placeholder="' . $label . '"' : $attributes) . ($required ? ' required' : '');
		switch ($type):
			case 'password':
				$input .= form_password($data, set_value($data, $value), $extra);
				break;
			case 'textarea':
				$input .= form_textarea($data, set_value($data, $value), $extra);
				break;
			case 'checkbox':
				$input .= '<div class="checkbox"><label>' . form_hidden($data, ($value ? 0 : 1)) . form_checkbox($data, $value, set_checkbox($data, $value, $check), 'id="' . $data . '"') . $hint . '</label></div>';
				break;
			case 'dropdown':
				$input .= form_dropdown($data, $value['options'], set_value($data, $value['selected']), $extra);
				break;
			default:
				$input .= form_input($data, set_value($data, $value), $extra);
				break;
		endswitch;
		if ($required) {
			$input .= form_error($data);
		}

		if (!empty($addon)) {
			$input .= '<span class="input-group-addon"><i class="' . $addon . '"></i></span>';
			$input .= '</div>';
		}
		$input .= '</div></div>';

		return $input;
	}

	if (!function_exists('bmsform_error')) {

		/**
		 * Return the html error class property value
		 *
		 * @param string $field
		 * @return string
		 */
		function bmsform_error($field) {
			if (FALSE === ($OBJ = & _get_validation_object())) {
				return '

		';
			}

			return $OBJ->error_css_class($field);
		}

	}
}