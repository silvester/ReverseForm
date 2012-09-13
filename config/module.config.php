<?php

return array(
    'view_helpers' => array(
        'invokables' => array(
            'slugify' => 'ReverseForm\View\Helper\Slugify',
        ),
        'factories' => array(
            'formRenderer' => function ($sm) {
                $me = new \ReverseForm\View\Helper\FormRenderer;
                $me->serviceManager = $sm;
                return $me;
            }
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'ReverseFormElements' => __DIR__ . '/../view/element',
        ),
    ),
    'reverse_form' => array(
        
        'settings' => array(
            'jsPlaceholderName' => 'reverse-js-placeholder'
        ),
        
        'ReverseForm\Renderer\Uniform' => array(
            'css' => array(
            	'/vendor/uni-form/css/uni-form.css',
                '/vendor/uni-form/css/default.uni-form.css'
            )
        ),
        
        'ReverseForm\Element\GoogleMap' => array(
            'js' => array(
            	'https://maps.google.com/maps/api/js?sensor=false&region=SI'
            ),
            'template' => 'googlemap.phtml'
        ),
        
        'ReverseForm\Element\JqueryUiDatepicker' => array(
            'js' => array('/vendor/jquery-ui/dist/minified/jquery.ui.core.min.js',
                '/vendor/jquery-ui/dist/minified/jquery.ui.datepicker.min.js'),
            'css' => array('/vendor/jquery-ui/dist/jquery-ui.css'),
            'template' => 'input.phtml',
        	'inlineJs' => "$('#%s').datepicker();"
        ),
        
        'ReverseForm\Element\JqueryUiDateRangePicker' => array(
            'js' => array(
            	'/vendor/jquery-ui/dist/minified/jquery.ui.core.min.js',
                '/vendor/jquery-ui/dist/minified/jquery.ui.datepicker.min.js',
                '/vendor/jQuery-UI-Date-Range-Picker/js/daterangepicker.jQuery.compressed.js'
            ),
            'css' => array(
            	'/vendor/jquery-ui/dist/jquery-ui.css',
                '/vendor/jQuery-UI-Date-Range-Picker/css/ui.daterangepicker.css'
            ),
            'template' => 'input.phtml',
        	'inlineJs' => "$('#%s').daterangepicker();"
        ),
        
        'ReverseForm\Element\BootstrapDatepicker' => array(
            'js' => array(
            	'/vendor/datepicker/js/bootstrap-datepicker.js'
            ),
            'css' => array(
            	'/vendor/datepicker/css/datepicker.css'
            ),
            'template' => 'input.phtml',
            'inlineJs' => "$('#%s').datepicker({format: 'dd.mm.yyyy', weekStart: 1});"
        ),
        
        'ReverseForm\Element\JqueryUiDatetimepicker' => array(
            'js' => array(
            	'/vendor/jQuery-Timepicker-Addon/jquery-ui-timepicker-addon.js',
                '/vendor/jquery-ui/dist/minified/jquery.ui.widget.min.js',
                '/vendor/jquery-ui/dist/minified/jquery.ui.mouse.min.js',
                '/vendor/jquery-ui/dist/minified/jquery.ui.slider.min.js'
            ),
            'css' => array(
            	'/vendor/jQuery-Timepicker-Addon/jquery-ui-timepicker-addon.css'
            ),
            'template' => 'input.phtml',
            'inlineJs' => "$('#%s').datetimepicker({closeText: 'zapri', currentText: 'zdaj', hourText: 'ura', minuteText: 'minuta'});"
        ),
        
    ),
    'service_manager' => array(
        'invokables' => array(
            'renderer.uniform' => 'ReverseForm\Renderer\Uniform',
            'renderer.bootstrap' => 'ReverseForm\Renderer\Bootstrap',
        )
    ),
);