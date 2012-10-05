<?php

namespace ReverseForm\Renderer;

use \ReverseForm\Renderer;
use \Zend\Form\Form;
use \ReverseForm\ExtendedElement;
use Zend\Form\Element\Collection as CollectionElement;
use Zend\Form\FieldsetInterface;
use Zend\Form\ElementInterface;

class Uniform extends Renderer
{

    public function setFormStyle($formStyle)
    {
        
        $this->_form->setAttribute('class', $this->_form->getAttribute('class').' uniForm');
        
        switch($formStyle)
        {
            case 'vertical':
                $this->_formStyle = '';
                break;
            
            case 'horizontal':
                $this->_formStyle = 'inlineLabels';
                break;
        }
        
        return $this;
        
    }
    
    public function formAction($fieldset)
    {
        return $this->view->partial('uniform/formAction.phtml', array('element' => $fieldset));
    }

    public function formRow($element)
    {

        $this->normalizeElement($element);
        
        if($element instanceOf ExtendedElement) {
            if(isset($this->globalFormConfig[get_class($element)])){
                $element->injectGlobalConfig(
                    $this->globalFormConfig[get_class($element)]
                );
            }
            $this->extractExtendedElementData($element);
            $element->injectSettings($this->getSettings());
        }

        if ($element instanceof ExtendedElement AND $element->getTemplate()) {
            return $this->view->partial('uniform/' . $element->getTemplate(), array('element' => $element));
        }

        if ($element->getAttribute('type') == 'checkbox' || $element->getAttribute('type') == 'radio') {
            return $this->view->partial('uniform/checkbox.phtml', array('element' => $element));
        }


        if ($element->getAttribute('type') == 'select') {
            return $this->view->partial('uniform/select.phtml', array('element' => $element));
        }


        if ($element->getAttribute('type') == 'textarea') {
            return $this->view->partial('uniform/textarea.phtml', array('element' => $element));
        }

        return $this->view->partial('uniform/input.phtml', array('element' => $element));

    }
    
    public function formCaptcha($element)
    {
        $this->normalizeElement($element);
        return $this->view->partial('uniform/captcha.phtml', array('element' => $element));
    }

    public function formCollection($element)
    {

        $renderer = $this->getView();

        if (!method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }

        $markup = '';
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();

        foreach ($element->getIterator() as $elementOrFieldset) {
            if ($elementOrFieldset instanceof FieldsetInterface) {
                $markup .= $this->formCollection($elementOrFieldset);
            } elseif ($elementOrFieldset instanceof ElementInterface) {
                $markup .= $this->formRow($elementOrFieldset);
            }
        }

        // Every collection is wrapped by a fieldset if needed
        if ($this->shouldWrap) {
            $label = $element->getLabel();
            if (!empty($label)) {
                $label = $escapeHtmlHelper($label);
                $markup = sprintf(
                        '<fieldset class="%s"><legend>%s</legend>%s</fieldset>', 
                        $this->_formStyle, 
                        $label,
                        $markup
                );
            }
        }

        return $markup;
    }
    
    public function normalizeElement($element)
    {
        
        parent::normalizeElement($element);
        
        $inputTypes = array('text', 'password', 'date', 'datetime', 'month', 'range', 'time', 'week', 'url', 'email');
        if(in_array($element->getAttribute('type'), $inputTypes)) {
            if(stristr($element->getAttribute('class'), 'textInput') === false) {
                $element->setAttribute('class', trim($element->getAttribute('class') . ' textInput'));
            }            
        };
        
        $fileTypes = array('file');
        if(in_array($element->getAttribute('type'), $fileTypes)) {
            if(stristr($element->getAttribute('class'), 'fileUpload') === false) {
                $element->setAttribute('class', trim($element->getAttribute('class') . ' fileUpload'));
            }            
        };
        
    }

}