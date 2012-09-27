<?php

namespace ReverseForm\Element;

use ReverseForm\ExtendedElement;

class ChosenSelect extends ExtendedElement
{
    protected $attributes = array(
        'type' => 'select'
    );
    
    /**
     * @var ValidatorInterface
     */
    protected $validator;
    
    /**
     * @var array
     */
    protected $valueOptions = array();
    
    /**
     * @return array
     */
    public function getValueOptions()
    {
    	return $this->valueOptions;
    }
    
    
    /**
     * @param  array $options
     * @return Select
     */
    public function setValueOptions(array $options)
    {
    	$this->valueOptions = $options;
    
    	// Update InArrayValidator validator haystack
    	if (!is_null($this->validator)) {
    		$validator = $this->validator instanceof InArrayValidator ? $this->validator : $this->validator->getValidator();
    		$validator->setHaystack($this->getValueOptionsValues());
    	}
    
    	return $this;
    }
    
    
    /**
     * Set options for an element. Accepted options are:
     * - label: label to associate with the element
     * - label_attributes: attributes to use when the label is rendered
     * - value_options: list of values and labels for the select options
     * _ empty_option: should an empty option be prepended to the options ?
     *
     * @param  array|\Traversable $options
     * @return Select|ElementInterface
     * @throws InvalidArgumentException
     */
    public function setOptions($options)
    {
    	parent::setOptions($options);
    
    	if (isset($this->options['value_options'])) {
    		$this->setValueOptions($this->options['value_options']);
    	}
    	// Alias for 'value_options'
    	if (isset($this->options['options'])) {
    		$this->setValueOptions($this->options['options']);
    	}
    
    	if (isset($this->options['empty_option'])) {
    		$this->setEmptyOption($this->options['empty_option']);
    	}
    
    	return $this;
    }
    
    
    /**
     * Set the string for an empty option (can be empty string). If set to null, no option will be added
     *
     * @param  string|null $emptyOption
     * @return Select
     */
    public function setEmptyOption($emptyOption)
    {
    	$this->emptyOption = $emptyOption;
    	return $this;
    }
    
    
    /**
     * Return the string for the empty option (null if none)
     *
     * @return string|null
     */
    public function getEmptyOption()
    {
    	return $this->emptyOption;
    }

}