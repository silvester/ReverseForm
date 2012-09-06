<?php

/* https://github.com/DASPRiD/Bacon stolen */

namespace ReverseForm\View\Helper;

use \Zend\View\Helper\AbstractHelper;

class Slugify extends AbstractHelper
{

    public function __invoke($string)
    {

        $string = strtolower($string);
        $string = str_replace("'", '', $string);
        $string = preg_replace('([^a-zA-Z0-9_-]+)', '-', $string);
        $string = preg_replace('(-{2,})', '-', $string);
        $string = trim($string, '-');

        return $string;

    }

}
