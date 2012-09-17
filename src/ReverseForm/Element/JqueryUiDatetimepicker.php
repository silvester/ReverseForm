<?php

namespace ReverseForm\Element;

use Zend\Json\Expr;

use ReverseForm\ExtendedElement;

$cf = array(
	'pattern' 		=> new Expr('/([0-3][0-9]).([0|1][0-9]).(\d{4})\s(\d{2}):(\d{2})$/'),
	'patternOrder' 	=> array(3, 2, 1, 4, 5),
	'monthMessages'	=> array('Januar', 'Februar', 'Marec', 'April', 'Maj', 'Juni', 'Juli', 'Avgust', 'September', 'Oktober', 'November', 'December'),
	'dayMessages'	=> array(
		'n' => array(0 => 'Danes', 1 => 'Včeraj', 2 => 'Pred 2 dnevoma', 'many' => 'Pred %s dnevi'),
		'p'	=> array(0 => 'Danes', 1 => 'Jutri', 'many' => 'Čez %s dni')
	),
	'nowDate'		=> new Expr('new Date()'),
	'dayOnly'		=> true,
	'hoverShow'		=> false,
	'makeTimeStamp'	=> new Expr('function(text) { alert(text); }') 
);

class JqueryUiDatetimepicker extends ExtendedElement
{

	protected $attributes = array(
		'type' => 'date',
	);


	
	
}