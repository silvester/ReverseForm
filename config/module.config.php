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
            'template' => 'googlemap.phtml',
        	'inlineJs' => "var map = new google.maps.Map(document.getElementById('%1\$s'), %2\$s);\n$('#%1\$s').data('map', map);",
        	'inlineJsConfig' => array(
        		'zoom' 		=>  8,
        		'mapTypeId'	=> new \Zend\Json\Expr('google.maps.MapTypeId.ROADMAP'),
        		'center'	=> new \Zend\Json\Expr('new google.maps.LatLng(46.15, 14.9)')
        	)
        ),
        
        'ReverseForm\Element\JqueryUiDatepicker' => array(
            'js' => array('/vendor/jquery-ui/dist/minified/jquery.ui.core.min.js',
                '/vendor/jquery-ui/dist/minified/jquery.ui.datepicker.min.js'),
            'css' => array('/vendor/jquery-ui/dist/jquery-ui.css'),
            'template' => 'input.phtml',
        	'inlineJs' => "$('#%1\$s').datepicker(%2\$s);\n"
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
        	'inlineJs' => "$('#%1\$s').daterangepicker(%2\$s);\n"
        ),
        
        'ReverseForm\Element\BootstrapDatepicker' => array(
            'js' => array(
            	'/vendor/datepicker/js/bootstrap-datepicker.js'
            ),
            'css' => array(
            	'/vendor/datepicker/css/datepicker.css'
            ),
            'template' => 'input.phtml',
            'inlineJs' => "$('#%1\$s').datepicker(%2\$s);",
        	'inlineJsConfig' => array(
        		'format'	=> 'dd.mm.yyyy',
        		'weekstart'	=> new \Zend\Json\Expr(1),	
        	)
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
            'inlineJs' => "$('#%1\$s').datetimepicker(%2\$s);\n",
        	'inlineJsConfig' => array(
        		'closeText' 	=> 'Zapri',
        		'currentText'	=> 'Zdaj',
        		'hourText'		=> 'Ura',
        		'minuteText'	=> 'Minuta'	
        	)
        ),
        
    ),
    'service_manager' => array(
        'invokables' => array(
            'renderer.uniform' => 'ReverseForm\Renderer\Uniform',
            'renderer.bootstrap' => 'ReverseForm\Renderer\Bootstrap',
        )
    ),
);