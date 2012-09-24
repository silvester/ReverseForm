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
            'inlineJs' => "var map = new google.maps.Map(document.getElementById('%1\$s'), %2\$s);\n$('#%1\$s').data('map', map);\n",
            'inlineJsConfig' => array(
                'zoom' 		=>  8,
                'mapTypeId'	=> new \Zend\Json\Expr('google.maps.MapTypeId.ROADMAP'),
                'center'	=> new \Zend\Json\Expr('new google.maps.LatLng(46.15, 14.9)')
            )
        ),

        'ReverseForm\Element\JqueryUiDatepicker' => array(
            'js' => array(
                '/vendor/jquery-ui/dist/minified/jquery.ui.core.min.js',
                '/vendor/jquery-ui/dist/minified/jquery.ui.datepicker.min.js'
            ),
            'css' => array(
                '/vendor/jquery-ui/dist/jquery-ui.css'
            ),
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
        
        'ReverseForm\Element\ChosenSelect' => array(
        	'js' => array(
        		'/vendor/chosen/chosen/chosen.jquery.min.js'
        	),
        	'css' => array(
        		'/vendor/chosen/chosen/chosen.css'
        	),
        	'template' => 'select.phtml',
        	'inlineJs' => "$('#%1\$s').chosen(%2\$s);\n",
        	'inlineJsConfig' => array(
        		'no_results_text' => 'No results matched !!!'
        	)
        ),
        
        'ReverseForm\Element\CodeMirror' => array(
        	'js' => array(
        		'/vendor/CodeMirror/lib/codemirror.js',
        	    '/vendor/CodeMirror/mode/xml/xml.js',
        	    '/vendor/CodeMirror/mode/javascript/javascript.js',
        	    '/vendor/CodeMirror/mode/css/css.js',
        	    '/vendor/CodeMirror/mode/clike/clike.js',
        	    '/vendor/CodeMirror/mode/php/php.js'
        	),
        	'css' => array(
        		'/vendor/CodeMirror/lib/codemirror.css'
        	),
        	'template' => 'textarea.phtml',
        	'inlineJs' => "var %1\$s = CodeMirror.fromTextArea(document.getElementById('%1\$s'), %2\$s);\n",
        	'inlineJsConfig' => array(
        		'lineNumbers'    => true,
        	    'matchBrackets'  => true,
        	    'mode'           => new \Zend\Json\Expr('"application/x-httpd-php"'),
        	    'indentUnit'     => 4,
        	    'indentWithTabs' => true,
        	    'enterMode'      => 'keep',
        	    'tabMode'        => 'shift'
        	)
        ),
        
        'ReverseForm\Element\TinyMce' => array(
        	'js' => array(
        		'/vendor/tinymce/jscripts/tiny_mce/jquery.tinymce.js'
        	),
        	'css' => array(),
        	'template' => 'textarea.phtml',
        	'inlineJs' => "$('#%1\$s').tinymce(%2\$s)\n",
        	'inlineJsConfig' => array(
        		'script_url'     => new \Zend\Json\Expr('"/vendor/tinymce/jscripts/tiny_mce/tiny_mce_jquery.js"'),
        		'theme'          => 'advanced',
                'skin'           => 'o2k7',
        	    'skin_variant'    => 'silver',
        	    'plugins'        => 'autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist',
        	    'theme_advanced_buttons1' => 'save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect',
        	    'theme_advanced_buttons2' => 'cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor',
        	    'theme_advanced_buttons3' => 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen',
        	    'theme_advanced_buttons4' => 'insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak',
        	    'theme_advanced_toolbar_location' => 'top',
        	    'theme_advanced_toolbar_align'    => 'left',
        	    'theme_advanced_statusbar_location' => 'bottom',
        	    'theme_advanced_resizing' => true,
        	    'content_css' => '/css/bootstrap.min.css',
        	    'template_external_list_url' => "lists/template_list.js",
        	    'external_link_list_url' => "lists/link_list.js",
        	    'external_image_list_url' => "lists/image_list.js",
        	    'media_external_list_url' => "lists/media_list.js"
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