<?php

namespace ReverseForm\Renderer;

use ReverseForm\Renderer;
use \ReverseForm\ExtendedElement;
use Zend\Form\FieldsetInterface;
use Zend\Form\ElementInterface;

class Bootstrap extends Renderer
{

    public function setFormStyle($formStyle)
    {

        switch ($formStyle) {
            case 'vertical':
                $this->_formStyle = '';
                break;

            case 'horizontal':
                $this->_formStyle = 'form-horizontal';
                break;
        }

        $this->_form->setAttribute('class', $this->_form->getAttribute('class') . ' ' . $this->_formStyle);

        return $this;

    }

    public function formAction($fieldset)
    {

        return $this->view->partial('bootstrap/formAction.phtml', array('element' => $fieldset));

    }

    public function formRow($element)
    {

        $this->normalizeElement($element);

        if ($element instanceOf ExtendedElement) {
            if (isset($this->globalFormConfig[get_class($element)])) {
                $element->injectGlobalConfig(
                    $this->globalFormConfig[get_class($element)]
                );
            }
            $this->extractExtendedElementData($element);
            $element->injectSettings($this->getSettings());
        }

        if ($element instanceof ExtendedElement AND $element->getTemplate()) {
            return $this->view->partial('bootstrap/' . $element->getTemplate(), array('element' => $element));
        }

        if (in_array($element->getAttribute('type'), array('checkbox', 'radio', 'multi_checkbox'))) {
            return $this->view->partial('bootstrap/checkbox.phtml', array('element' => $element));
        }

        if ($element->getAttribute('type') == 'select') {
            return $this->view->partial('bootstrap/select.phtml', array('element' => $element));
        }

        if ($element->getAttribute('type') == 'textarea') {
            return $this->view->partial('bootstrap/textarea.phtml', array('element' => $element));
        }

        return $this->view->partial('bootstrap/input.phtml', array('element' => $element));
    }

    public function formCaptcha($element)
    {
        $this->normalizeElement($element);
        return $this->view->partial('bootstrap/captcha.phtml', array('element' => $element));
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
                    '<fieldset><legend>%s</legend>%s</fieldset>', $label, $markup
                );
            }
        }

        return $markup;

    }

}
