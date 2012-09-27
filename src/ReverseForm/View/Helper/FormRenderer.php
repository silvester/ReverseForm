<?php

namespace ReverseForm\View\Helper;

use \Zend\View\Helper\AbstractHelper;
use \Zend\Form\Form;

class FormRenderer extends AbstractHelper
{

    public function __invoke(Form $form, $type, $style)
    {

        $formRenderer = $this->serviceManager->getServiceLocator()->get($type);
        $formRenderer->setForm($form);
        $formRenderer->setFormStyle($style);
        $formRenderer->setView($this->view);

        return $formRenderer;

    }

}
