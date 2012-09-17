<?php

namespace ReverseForm;

use \Zend\Json\Encoder;
use \Zend\Json\Expr;


class JsConfigRenderer extends Encoder
{
	
	public static function encode($value, $cycleCheck = false, $options = array())
    {
    	if(empty($value)) { return;}
    	
        $encoder = new self(($cycleCheck) ? true : false, $options);
        return $encoder->_encodeValue($value);
    }
	
	protected function _encodeObject(&$value)
	{
		if($value instanceof Expr) {
			return $value;
		} else {
			parent::_encodeObject($value);
		}
	}
	
	protected function _encodeArray(&$array)
	{
		$tmpArray = array();
	
		// Check for associative array
		if (!empty($array) && (array_keys($array) !== range(0, count($array) - 1))) {
			// Associative array
			$result = '{';
			foreach ($array as $key => $value) {
				$key = (string) $key;
				//$tmpArray[] = $this->_encodeString($key)
				$tmpArray[] = $key
				. ':'
				. $this->_encodeValue($value);
			}
			$result .= implode(',', $tmpArray);
			$result .= '}';
		} else {
			// Indexed array
			$result = '[';
			$length = count($array);
			for ($i = 0; $i < $length; $i++) {
				$tmpArray[] = $this->_encodeValue($array[$i]);
			}
			$result .= implode(',', $tmpArray);
			$result .= ']';
		}
	
		return $result;
	}
	
}