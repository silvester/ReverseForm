<?php

namespace ReverseForm\View\Helper;

use Zend\Form\View\Helper\Captcha\AbstractWord;

class CaptchaInputs extends AbstractWord
{

    public function __invoke($element)
    {

        return $this->renderCaptchaInputs($element);

    }

}
