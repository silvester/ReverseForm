ReverseForm
===========

This is an early alpha, things do work but may be changed how they work in future.

Uni-Form form demo at: http://reverseform.modo.si/form/test-uniform

Twitter Bootstrap form demo at: http://reverseform.modo.si/form/test-bootstrap

Introduction
------------

ReverseForm is a form rendering module. It creates the renderer objects through 
a view helper. It also provides an object which extends Zend\Form\Element called 
ReverseForm\ExtendedElement which will be usefull to create more complicated elements faster.

Goals
-----

* Support other frameworks for rendering forms like mobile ones.
* Add an unified way of creating new elements. It should take care of the JS, CSS and configuration part of an element.
* Elements should honor localization.

Form Renderers
--------------

Currently I provide 2 types of renderers, but it is simple to create other renderers by
 extending the ReverseForm\Renderer. Before you start take a look at the `/config/module.config.php` all of the options are there.

* ReverseForm\Renderer\Uniform renders the form with extra markup to make it work with 
[Uni-Form](http://sprawsm.com/uni-form/).
* ReverseForm\Renderer\Bootstrap obviously renders [Twitter Bootstrap](http://twitter.github.com/bootstrap/).

### Uniform Renderer

    <?php
    $this->form->setAttribute('action', $this->url('album', array('action' => 'test-form')));
    $formRenderer = $this->formRenderer($form, 'renderer.uniform', 'vertical'); // vertical or horizontal
    $formRenderer->prepare(); // this is how you create it in your viewscript

Get your css from [Uni-Form](http://sprawsm.com/uni-form/). Check the path to load the files in the module_config.php.

### Bootstrap Renderer

    <?php
    $this->form->setAttribute('action', $this->url('album', array('action' => 'test-form')));
    $formRenderer = $this->formRenderer($form, 'renderer.bootstrap', 'vertical'); // vertical or horizontal
    $formRenderer->prepare(); // this is how you create it in your viewscript

It does not auto load any css or js files in to your view. If you need to load extra files you can do it from the configuration.

Usage
-----

### In your view script do:

	<h1>Form Testing</h1>
	<?php
	$form = $this->form;
	$form->setAttribute('action', $this->url('album', array('action' => 'test-form')));
	$formRenderer = $this->formRenderer($form, 'renderer.uniform', 'horizontal');
	$formRenderer->prepare();
	echo $formRenderer->openTag();
	?>
	
	<div class="well">
	    <?php print_r($form->getMessages()); ?>
	</div>
	
	<fieldset class="<?= $formRenderer->_formStyle; ?>">
	
	<legend>Some Legend</legend>
	
	<?= $formRenderer->formHidden($form->get('security')); ?>
	<?= $formRenderer->formRow($form->get('status')); ?>
	<?= $formRenderer->formRow($form->get('status2')); ?>
	<?= $formRenderer->formRow($form->get('status3')); ?>
	
	<?= $formRenderer->formRow($form->get('codemirrortest')); ?>
	<?= $formRenderer->formRow($form->get('tinymcetest')); ?>
	
	<?= $formRenderer->formRow($form->get('datepicker')); ?>
	<?= $formRenderer->formRow($form->get('datetimepicker')); ?>
	<?= $formRenderer->formRow($form->get('daterangepicker')); ?>
	<?= $formRenderer->formCaptcha($form->get('captchaImage')); ?>
	
	<?= $formRenderer->formRow($form->get('gmap')); ?>
	<?= $formRenderer->formRow($form->get('artist')); ?>
	<?= $formRenderer->formRow($form->get('title')); ?>
	<?= $formRenderer->formRow($form->get('file')); ?>
	
	<?= $formRenderer->formRow($form->get('countrytextarea')); ?>
	<?= $formRenderer->formAction($form->get('actions')); ?>
	</fieldset>
	
	<?= $formRenderer->closeTag(); ?>
	
	<script>$(document).ready(function(){<?= $formRenderer->getElementJsContent(); ?>});</script>


### In your action do:

    $form = new ReverseForm\Form\TestForm();

    if ($this->getRequest()->isPost()) {

        $form->setInputFilter(new InputFilter);

        $form->setData($this->getRequest()->getPost());

    }

    return array('form' => $form, 'post' => $this->getRequest()->getPost());

You would do it better
----------------------

Feel free to improve it. Will merge them in to the project and thank you.

TODO
---

* Many element view scripts look the same, only difference is the js part. 
Refactor all same looking elements in to one viewscript. COMPLETED.
* Write some decent documentation.
* Demo module is on it's way.
* Figure out fieldset templates current way is too ugly