ReverseForm
===========

This is an early alpha, things do work but may be changed how they work in future. 

Introduction
------------

ReverseForm is a form rendering module. It creates the renderer objects through 
a view helper. It also provides an object which extends Zend\Form\Element called 
ReverseFor\ExtendedElement which will be usefull to create more complicated elements faster.

Goals
-----

* Support other frameworks for rendering forms like mobile ones.
* Add an unified way of creating new elements. It should take care of the JS, CSS and configuration part of an element.
* Elements should honor localization.

Form Renderers
--------------

Currently I provide 2 types of renderers, but it is simple to create other renderers by
 extending the ReverseForm\Renderer.

* ReverseForm\Renderer\Uniform renders the form with extra markup to make it work with 
[Uni-Form](http://sprawsm.com/uni-form/) Uni-Form.
* ReverseForm\Renderer\Bootstrap obviously renders 
[Twitter Bootstrap](http://twitter.github.com/bootstrap/) Twitter bootstrap.

### Uniform Renderer

    <?php
    $this->form->setAttribute('action', $this->url('album', array('action' => 'test-form')));
    $formRenderer = $this->formRenderer($form, 'renderer.uniform', 'vertical'); // vertical or horizontal
    $formRenderer->prepare(); // this is how you create it in your viewscript

Get your css from [Uni-Form](http://sprawsm.com/uni-form/) Uni-Form. Check the path to load the files in the module_config.php.

### Bootstrap Renderer

    <?php
    $this->form->setAttribute('action', $this->url('album', array('action' => 'test-form')));
    $formRenderer = $this->formRenderer($form, 'renderer.bootstrap', 'vertical'); // vertical or horizontal
    $formRenderer->prepare(); // this is how you create it in your viewscript

It does not auto load any css or js files in to your view. If you need to load extra files you can do it from the configuration.

Usage
-----

### In your view script do:

    <?php
        $form = $this->form;
        $form->setAttribute('action', $this->url('album', array('action' => 'test-form')));
        $formRenderer = $this->formRenderer($form, 'renderer.bootstrap', 'horizontal');
        $formRenderer->prepare();
        echo $formRenderer->openTag();
    ?>
    <fieldset class="<?= $formRenderer->_formStyle; ?>">
    <legend>Some Legend</legend>
    <?= $formRenderer->formHidden($form->get('security')); ?>
    <?= $formRenderer->formRow($form->get('status')); ?>
    <?= $formRenderer->formRow($form->get('status2')); ?>
    <?= $formRenderer->formRow($form->get('status3')); ?>

    <?= $formRenderer->formRow($form->get('datepicker')); ?>
    <?= $formRenderer->formRow($form->get('datetimepicker')); ?>

    <?php //$formRenderer->formRow($form->get('bootstrap-datepicker')); ?>

    <?= $formRenderer->formRow($form->get('gmap')); ?>

    <?= $formRenderer->formRow($form->get('artist')); ?>
    <?= $formRenderer->formRow($form->get('title')); ?>
    <?= $formRenderer->formRow($form->get('file')); ?>

    <?= $formRenderer->formRow($form->get('countrytextarea')); ?>
    <?= $formRenderer->formAction($form->get('actions')); ?>
    </fieldset>
    <?= $formRenderer->closeTag(); ?>
    <script>
    $(document).ready(function(){
        <?= $formRenderer->getElementJsContent(); ?>
    });
    </script>


### In your action do:

    $form = new ReverseForm\Form\TestForm();

    if ($this->getRequest()->isPost()) {

        $form->setInputFilter(new InputFilter);

        $form->setData($this->getRequest()->getPost());

    }

    return array('form' => $form, 'post' => $this->getRequest()->getPost());

You would do it better
----------------------

Feel free to improve it. Will merge them to the project and thank you.