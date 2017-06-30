<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	
if (!function_exists("tag")) {

	function tag($text){
		$tag = array(''=>'', '<o p=""></o>'=>'<o p=""></o>');
		foreach ($tag as $key => $value) {
			var_dump($value);
		}
	}
}