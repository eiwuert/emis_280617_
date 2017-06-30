<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	
if (!function_exists("print_chinese")) {
	function print_chinese($text, $max_size) {
		$count = 0;
	    for($i = 0; $i<strlen($text); $i++){
	        echo $text[$i];
	        if(ord($text[$i]) > ord('~')){
	            $count++;
	        }else{
	            $count = 0;
	        }

	        if($count == $max_size*3){
	            echo PHP_EOL;
	            $count = 0;
	        } 
	    }
	}
}