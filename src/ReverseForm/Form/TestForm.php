<?php

namespace ReverseForm\Form;

use Zend\Form\Form;

class TestForm extends Form
{

    public function __construct()
    {

        parent::__construct();

        $this->setName('test');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'artist',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
                'value'     => 'Angel'
            ),
            'options' => array(
                'label' => 'Artist',
            ),
        ));

        $this->add(array(
            'name' => 'file',
            'attributes' => array(
                'type' => 'file'
            ),
            'options' => array(
                'label' => 'Some file input',
            ),
        ));

        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-mini'
            ),
            'options' => array(
                'label' => 'Title',
                'extended' => array(
                    'help' => array('style' => 'block', 'content' => 'do some stuff'),
                    'prepend' => '$',
                    'append' => '€'
                )
            ),
        ));
        
        $this->add(array(
            'name' => 'uispinner',
            'type' => '\ReverseForm\Element\JqueryUiSpinner',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => 'Ui Spinner',
                'extended' => array(
                    'help' => array('style' => 'block', 'content' => 'Some UI Spinner'),
                    'append' => '€'
                )
            ),
        ));

        $this->add(
            array(
                'name' => 'gmap',
                'type' => '\ReverseForm\Element\GoogleMap',
                'options' => array(
                    'label' => 'Google Map',
                    'extended' => array(
                        'help'      => array('content' => 'Some Google Map')
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'datepicker',
                'type' => '\ReverseForm\Element\JqueryUiDatepicker',
                'attributes' => array('required' => 'required'),
                'options' => array(
                    'label' => 'Ui datepicker',
                    'extended' => array(
                        'help'      => array('content' => 'Some UI datepicker'),
                        'js'        => array(2 => '/js/jqueryui/ui/i18n/jquery.ui.datepicker-sl.js'), // add i18n support
                        'append'    => 'some stuff' // only in twitter bootstrap
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'datetimepicker',
                'type' => '\ReverseForm\Element\JqueryUiDatetimepicker',
                'attributes' => array('required' => 'required'),
                'options' => array(
                    'label' => 'Ui datetimepicker',
                    'extended' => array(
                        'help'      => array('content' => 'Some UI datetimepicker'),
                        'inlineJsConfig' => array('closeText' => 'Kapat')
                    )
                )
            )
        );

        
        $this->add(
            array(
                'name' => 'daterangepicker',
                'type' => '\ReverseForm\Element\JqueryUiDateRangePicker',
                'attributes' => array('required' => 'required'),
                'options' => array(
                    'label' => 'Ui daterangepicker',
                    'extended' => array(
                        'help' => array('content' => 'Some UI daterangepicker')
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'bootstrap-datepicker',
                'type' => '\ReverseForm\Element\BootstrapDatepicker',
                'attributes' => array('required' => 'required'),
                'options' => array(
                    'label' => 'Boostrap datepicker',
                    'extended' => array(
                        'help' => array('content' => 'Bootstrap datepicker')
                    )
                )
            )
        );

        $this->add(array(
            'name' => 'status',
            'required' => true,
            'attributes' => array('type' => 'checkbox', 'required' => 'required', 'value' => 1),
            'options' => array(
                'label' => 'Status',
                'extended' => array('help' => array('content' => 'some help'), 'compact' => false),
                'value_options'   => array(1 => 'ON', 0 => 'OFF')
            )
        ));

        $this->add(array(
            'name' => 'status2',
            'attributes' => array('type' => 'radio', 'required' => 'required', 'value' => 2),
            'options' => array(
                'label' => 'Status 2',
                'extended' => array('help' => array('content' => 'some help 2'), 'compact' => true),
                'value_options'   => array(1 => 'ON', 0 => 'OFF'),
            )
        ));

        $this->add(array(
            'name' => 'status3',
            'type'  => 'Zend\Form\Element\Select',
            'attributes' => array('value' => 2),
            'options' => array(
                'label'     => 'Status 3',
                'extended'  => array('help' => array('content' => 'some help 3')),
                'value_options'   => array(1 => 'ON', 0 => 'OFF'),
                'value_options'   => $this->getf(),
            )
        ));
        
        $this->add(array(
        	'name' => 'status4',
        	'type'  => 'ReverseForm\Element\ChosenSelect',
        	'attributes' => array('required' => 'required', 'multiple' => 'multiple'),
        	'options' => array(
        		'label'     => 'Chosen JS',
        		'extended'  => array('help' => array('content' => 'Chosen JS')),
        		'value_options'   => $this->getf(),
        	    'empty_option'    => 'choose Some'
        	)
        ));
        
        $this->add(array(
        	'name' => 'codemirrortest',
        	'type'  => 'ReverseForm\Element\CodeMirror',
        	'attributes' => array('required' => 'required'),
        	'options' => array(
        		'label'     => 'CodeMirror',
        		'extended'  => array('help' => array('content' => 'CodeMirror'))
        	)
        ));
        
        $this->add(array(
        	'name' => 'tinymcetest',
        	'type'  => 'ReverseForm\Element\TinyMce',
        	'attributes' => array('value' => '', 'rows' => 20),
        	'options' => array(
        		'label'     => 'Tiny MCE',
        		'extended'  => array('help' => array('content' => 'Tiny MCE'))
        	)
        ));
        
        
        
        $captchaImage = new \Zend\Form\Element\Captcha('captchaImage');
        $captchaImage->setCaptcha(new \Zend\Captcha\Image(array('font' => '/var/www/akrabat.modo.si/data/font20.ttf', 'wordlen' => 4)));
        $captchaImage->setLabel('Please verify you are human OK ?');
        $captchaImage->setAttribute('class', 'textInput');
        
        $this->add($captchaImage);        

        $actions = new \Zend\Form\Fieldset('actions');
        $actions->add(array(
            'name' => 'submit',
            'attributes' => array('type' => 'submit', 'value' => 'Save', 'class' => 'btn btn-primary'),
            'attributes' => array('type' => 'submit', 'value' => 'Save', 'class' => 'primaryAction'),
            'options'   => array('label' => 'Submit')
        ));
        $actions->add(array(
            'name' => 'reset',
            'attributes' => array('type' => 'reset', 'value' => 'reset', 'class' => 'btn'),
            'attributes' => array('type' => 'reset', 'value' => 'reset', 'class' => 'secondaryAction'),
            'options'   => array('label' => 'Reset')
        ));

        $this->add($actions);


        $this->add(array(
            'name' => 'countrytextarea',
            'attributes' => array(
                'type' => 'textarea',
            ),
            'options' => array(
                'label' => 'country textarea',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security'
        ));

    }
    
    public function getf()
    {
        
        return array(
            1 => 'kull',
            2 => 'not so kull',
            'yurope' => array('options' => array(1 => 'kull', 2 => 'not soo kul'), 'label' => 'yurope')
        );
                
    }

}