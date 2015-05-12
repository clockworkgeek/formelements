<?php

class Clockworkgeek_Data_Form_Element_Color extends Varien_Data_Form_Element_Text
{
    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setType('color');
        // set a pattern for modern browsers without a color control
        $this->setPattern('^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$');
    
        if (strpos($this->getClass(), 'validate-color') === false) {
            $this->setClass($this->getClass().' validate-color');
        }
    }

    public function getHtmlAttributes()
    {
        $attrs = parent::getHtmlAttributes();
        $attrs[] = 'pattern';
        return $attrs;
    }
}
