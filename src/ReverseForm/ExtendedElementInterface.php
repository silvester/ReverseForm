<?php

namespace ReverseForm;

interface ExtendedElementInterface
{
    
    public function getJs();
    
    public function getCss();
    
    public function getInlineJs();
    
    public function injectGlobalConfig($config);
    
}