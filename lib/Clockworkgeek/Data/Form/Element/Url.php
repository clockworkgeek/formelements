<?php

class Clockworkgeek_Data_Form_Element_Url extends Varien_Data_Form_Element_Text
{
    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setType('url');
    
        if (strpos($this->getClass(), 'validate-url') === false) {
            $this->setClass($this->getClass().' validate-url');
        }
    }
}
