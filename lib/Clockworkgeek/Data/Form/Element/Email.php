<?php

class Clockworkgeek_Data_Form_Element_Email extends Varien_Data_Form_Element_Text
{
    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setType('email');
    
        if (strpos($this->getClass(), 'validate-email') === false) {
            $this->setClass($this->getClass().' validate-email');
        }
    }
}
