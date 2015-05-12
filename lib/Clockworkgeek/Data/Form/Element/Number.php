<?php

class Clockworkgeek_Data_Form_Element_Number extends Varien_Data_Form_Element_Text
{
    public function __construct($attributes=array())
    {
        if (isset($attributes['required']) && ! $attributes['required']) {
            unset($attributes['required']);
        }
        parent::__construct($attributes);
        $this->setType('number');
        $this->setPattern('[-+]?[0-9]*[.,]?[0-9]+');
        // change appearance because firefox is fugly
        $this->setStyle('-moz-appearance:textfield;width:110px;'.$this->getStyle());

        if (strpos($this->getClass(), 'validate-number') === false) {
            $this->setClass($this->getClass().' validate-number');
        }
    }

    public function getHtmlAttributes()
    {
        $attrs = parent::getHtmlAttributes();
        $attrs[] = 'min';
        $attrs[] = 'max';
        $attrs[] = 'pattern';
        $attrs[] = 'required';
        $attrs[] = 'step';
        return $attrs;
    }
}
