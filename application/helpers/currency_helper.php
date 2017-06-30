<?php
function to_currency($number, $decimals = 2)
{
	$CI =& get_instance();
	$currency_symbol = $CI->config->item('currency_symbol') ? $CI->config->item('currency_symbol') : 'S$';
	if($number >= 0)
	{
		$ret = $currency_symbol.number_format($number, $decimals, '.', ',');
    }
    else
    {
    	$ret = '&#8209;'.$currency_symbol.number_format(abs($number), $decimals, '.', ',');
    }

	return preg_replace('/(?<=\d{2})0+$/', '', $ret);
}

function none_currency($number, $decimals = 2)
{
	$CI =& get_instance();
	$currency_symbol = $CI->config->item('currency_symbol') ? $CI->config->item('currency_symbol') : '';
	if($number >= 0)
	{
		$ret = $currency_symbol.number_format($number, $decimals, '.', ',');
    }
    else
    {
    	$ret = '&#8209;'.$currency_symbol.number_format(abs($number), $decimals, '.', ',');
    }

	return preg_replace('/(?<=\d{2})0+$/', '', $ret);
}
function round_to_nearest_05($amount)
{
	return round($amount * 2, 1) / 2;
}

function to_currency_no_money($number, $decimals = 2)
{
	$ret = number_format($number, $decimals, '.', '');
	return preg_replace('/(?<=\d{2})0+$/', '', $ret);
}

function to_quantity($val)
{
	if ($val !== NULL)
	{
		return $val == (int)$val ? (int)$val : rtrim($val, '0');		
	}
	
	return lang('common_not_set');
}



function convert_number($number) { 
		if (($number < 0) || ($number > 999999999)) 
		{ 
		throw new Exception("Number is out of range");
		} 
		$Gn = floor($number / 1000000);  /* Millions (giga) */ 
		$number -= $Gn * 1000000; 
		$kn = floor($number / 1000);     /* Thousands (kilo) */ 
		$number -= $kn * 1000; 
		$Hn = floor($number / 100);      /* Hundreds (hecto) */ 
		$number -= $Hn * 100; 
		$Dn = floor($number / 10);       /* Tens (deca) */ 
		$n = $number % 10;               /* Ones */ 
		$res = ""; 
		if ($Gn) 
		{ 
			$res .= convert_number($Gn) . " Million"; 
		} 
		if ($kn) 
		{ 
			$res .= (empty($res) ? "" : " ") . 
				convert_number($kn) . " Thousand"; 
		} 
		if ($Hn) 
		{ 
			$res .= (empty($res) ? "" : " ") . 
				convert_number($Hn) . " Hundred"; 
		} 
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); 
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
			"Seventy", "Eigthy", "Ninety"); 

		if ($Dn || $n) 
		{ 
			if (!empty($res)) 
			{ 
				$res .= " "; 
			} 
			if ($Dn < 2) 
			{ 
				$res .= $ones[$Dn * 10 + $n]; 
			} 
			else 
			{ 
				$res .= $tens[$Dn]; 
				if ($n) 
				{ 
					$res .= " " . $ones[$n]; 
				} 
			} 
		} 
		if (empty($res)) 
		{ 
			$res = "zero"; 
		} 

		return $res; 
	} 
	
	function convert($c)
	{
		$num2 = 0;
		if(strpos($c, ".") == TRUE)
		{
		$d = explode(".", $c);

			if($d[1] > 10)
			{
				//add 0 to front
				$r = round($c, 2);
				$d1 = explode(".", $r);
				if(empty($d1[1]))
				{
					$num2 = convert_number($d1[0])." ONLY";
				}
				else
				{
					if(strlen($d1[1]) == 1)
					{
						$fd = $d1[1]."0";
						$num2 = convert_number($d1[0])." AND CENTS ".convert_number($fd)." ONLY";
					}
					else
					{
						$num2 = convert_number($d1[0])." AND CENTS ".convert_number($d1[1])." ONLY";
					}
				}
			}
			else
			{
			//add 0 to back
				$r = round($c, 2);
				$d1 = explode(".", $r);
				if(empty($d1[1]))
				{
					$num2 = convert_number($d1[0])." ONLY";
				}
				else
				{				
					if(strlen($d1[1]) == 1)
					{
						$num2 = $d1[0].".".$d1[1]."0" ;
						$fd = $d1[1]."0";
						$num2 = convert_number($d1[0])." AND CENTS ".convert_number($fd)." ONLY";
					}
					else
					{
						$num2 = $d1[0].".".$d1[1];
						$num2 = convert_number($d1[0])." AND CENTS ".convert_number($d1[1])." ONLY";
					}
				}
			}
		}
		else
		{
			$num2 = convert_number($c)." ONLY";
		}
		return strtoupper($num2);
	}

?>