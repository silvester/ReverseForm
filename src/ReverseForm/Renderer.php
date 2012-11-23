<?php

namespace ReverseForm;

use Zend\Form\Form;
use Zend\Form\View\Helper\FormElement;
use Zend\Form\View\Helper\FormLabel;
use Zend\Form\View\Helper\FormElementErrors;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\View\Helper\EscapeHtml;
use Zend\View\Helper\EscapeHtmlAttr;

class Renderer implements ServiceManagerAwareInterface
{

    public $view = false;
    protected $serviceManager;
    public $_form;
    public $_formStyle;
    public $shouldWrap = true;

    public $localConfig = array();
    public $globalFormConfig = array();

    public function setFormStyle($formStyle)
    {
        $this->_formStyle = $formStyle;
        return $this;
    }

    public function setForm(Form $form)
    {
        $this->_form = $form;
        $this->_form->setAttribute('novalidate', 'novalidate');
        return $this;
    }

    public function getForm()
    {
        return $this->_form;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    public function getView()
    {
        return $this->view;
    }

    public function getCss()
    {
        return (isset($this->localConfig['css'])) ? $this->localConfig['css'] : false;
    }

    public function getJs()
    {
        return (isset($this->localConfig['js'])) ? $this->localConfig['js'] : false;
    }

    public function getSettings()
    {
        return (isset($this->globalFormConfig['settings'])) ? $this->globalFormConfig['settings'] : false;
    }

    public function getJsHolderName()
    {
        return $this->globalFormConfig['settings']['jsPlaceholderName'];
    }

    public function getElementJsContent()
    {
        return $this->view->placeholder($this->getJsHolderName());
    }

    public function prepareRenderer()
    {
        if ($this->getCss() AND $this->view) {
            foreach ($this->getCss() as $c) {
                $this->view->headLink()->appendStylesheet($c);
            }
        }
        if ($this->getJs() AND $this->view) {
            foreach ($this->getJs() as $j) {
                $this->view->headScript()->appendFile($j, 'text/javascript');
            }
        }
    }

    public function prepare()
    {

        $this->prepareRenderer();

        $this->_form->prepare();

    }

    public function openTag()
    {
        return $this->view->form()->openTag($this->_form);
    }

    public function closeTag()
    {
        return $this->view->form()->closeTag();
    }

    public function extractExtendedElementData($element)
    {

        if ($element instanceOf ExtendedElement AND $this->view) {

            if ($js = $element->getJs() AND is_array($js)) {
                foreach ($js as $j) {
                    $this->view->headScript()->appendFile($j, 'text/javascript');
                }
            }

            if ($css = $element->getCss() AND is_array($css)) {
                foreach ($css as $c) {
                    $this->view->headLink()->appendStylesheet($c);
                }
            }

            if ($inlineJs = $element->getInlineJs() AND strlen($inlineJs) > 0) {
                $this->view->placeholder($this->getJsHolderName())
                    ->append(sprintf($inlineJs, $element->getAttribute('id'), JsConfigRenderer::encode($element->getInlineJsConfig())));
            }

        }

    }

    public function normalizeElement($element)
    {
        if (!$element->getAttribute('id')) {
            $element->setAttribute('id', $this->getView()->slugify($element->getName()));
        }
    }

    public function formRow($element)
    {
        // implement it in the specific renderer
    }

    public function formCollection($element)
    {
        // implement it in the specific renderer
    }

    public function formCaptcha($element)
    {
        // implement it in the specific renderer
    }

    public function formHidden($element)
    {
        return $this->view->formHidden($element);
    }

    /**
     * Retrieve the FormLabel helper
     *
     * @return FormLabel
     */

    protected function getLabelHelper()
    {
        if ($this->labelHelper) {
            return $this->labelHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->labelHelper = $this->view->plugin('form_label');
        }

        if (!$this->labelHelper instanceof FormLabel) {
            $this->labelHelper = new FormLabel;
        }

        return $this->labelHelper;
    }

    /**
     * Retrieve the FormElement helper
     *
     * @return FormElement
     */

    protected function getElementHelper()
    {
        if ($this->elementHelper) {
            return $this->elementHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementHelper = $this->view->plugin('form_element');
        }

        if (!$this->elementHelper instanceof FormElement) {
            $this->elementHelper = new FormElement;
        }

        return $this->elementHelper;
    }

    /**
     * Retrieve the FormElementErrors helper
     *
     * @return FormElementErrors
     */

    protected function getElementErrorsHelper()
    {
        if ($this->elementErrorsHelper) {
            return $this->elementErrorsHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementErrorsHelper = $this->view->plugin('form_element_errors');
        }

        if (!$this->elementErrorsHelper instanceof FormElementErrors) {
            $this->elementErrorsHelper = new FormElementErrors();
        }

        return $this->elementErrorsHelper;
    }

    /**
     * Retrieve the escapeHtml helper
     *
     * @return EscapeHtml
     */

    protected function getEscapeHtmlHelper()
    {
        if ($this->escapeHtmlHelper) {
            return $this->escapeHtmlHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->escapeHtmlHelper = $this->view->plugin('escapehtml');
        }

        if (!$this->escapeHtmlHelper instanceof EscapeHtml) {
            $this->escapeHtmlHelper = new EscapeHtml();
        }

        return $this->escapeHtmlHelper;
    }

    /**
     * Retrieve the escapeHtmlAttr helper
     *
     * @return EscapeHtmlAttr
     */

    protected function getEscapeHtmlAttrHelper()
    {
        if ($this->escapeHtmlAttrHelper) {
            return $this->escapeHtmlAttrHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->escapeHtmlAttrHelper = $this->view->plugin('escapehtmlattr');
        }

        if (!$this->escapeHtmlAttrHelper instanceof EscapeHtmlAttr) {
            $this->escapeHtmlAttrHelper = new EscapeHtmlAttr();
        }

        return $this->escapeHtmlAttrHelper;
    }

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $conf = $this->serviceManager->get('config');
        $this->globalFormConfig = $conf['reverse_form'];
        if (array_key_exists(get_class($this), $this->globalFormConfig)) {
            $this->localConfig = $this->globalFormConfig[get_class($this)];
        }
        return $this;
    }

}
