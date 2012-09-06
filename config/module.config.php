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
            'css' => array('/css/uni-form/css/uni-form.css',
                '/css/uni-form/css/default.uni-form.css'),
        ),
        'ReverseForm\Element\GoogleMap' => array(
            'js' => array('https://maps.google.com/maps/api/js?sensor=false&region=SI'),
            'template' => 'googlemap.phtml'
        ),
        'ReverseForm\Element\JqueryUiDatepicker' => array(
            'js' => array('/js/jqueryui/ui/minified/jquery.ui.core.min.js',
                '/js/jqueryui/ui/minified/jquery.ui.datepicker.min.js'),
            'css' => array('/js/jqueryui/themes/smoothness/jquery.ui.all.css'),
            'template' => 'jqueryuidatepicker.phtml'
        ),
        'ReverseForm\Element\BootstrapDatepicker' => array(
            'js' => array('/js/bootstrap-datepicker.js'),
            'css' => array('/css/datepicker.css'),
            'template' => 'bootstrapdatepicker.phtml',
            'inlineJs' => "$('#%s').datepicker({format: 'dd.mm.yyyy', weekStart: 1});"
        ),
        'ReverseForm\Element\JqueryUiDatetimepicker' => array(
            'js' => array('/js/jquery-ui-timepicker-addon.js',
                '/js/jqueryui/ui/minified/jquery.ui.widget.min.js',
                '/js/jqueryui/ui/minified/jquery.ui.mouse.min.js',
                '/js/jqueryui/ui/minified/jquery.ui.slider.min.js'),
            'css' => array('/css/jquery-ui-timepicker-addon.css'),
            'template' => 'jqueryuidatetimepicker.phtml',
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