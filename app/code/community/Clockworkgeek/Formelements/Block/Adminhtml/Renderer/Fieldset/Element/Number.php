<?php

class Clockworkgeek_Formelements_Block_Adminhtml_Renderer_Fieldset_Element_Number
extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset_Element
{

    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        if (! ($element instanceof Clockworkgeek_Formelements_Block_Number)) {
            $number = new Clockworkgeek_Data_Form_Element_Number($element->getData());
            $number->setForm($element->getForm());
            $number->setId($element->getId());
            $element = $number;
        }
        return parent::render($element);
    }
}
