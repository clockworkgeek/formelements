<?php

class Clockworkgeek_Data_Form extends Varien_Data_Form
{

    protected function _construct()
    {
        parent::_construct();
        $this->_updateTypes($this);
    }

    public function addElement(Varien_Data_Form_Element_Abstract $element, $after = null)
    {
        // only updates immediate children, what about nested fieldsets?
        $this->_updateTypes($element);
        return parent::addElement($element, $after);
    }

    /**
     * Force own types on $element
     * 
     * @param Varien_Data_Form_Element_Abstract $element
     */
    protected function _updateTypes(Varien_Data_Form_Abstract $element)
    {
        $element->addType('color', 'Clockworkgeek_Data_Form_Element_Color');
        $element->addType('email', 'Clockworkgeek_Data_Form_Element_Email');
        $element->addType('mediaurl', 'Clockworkgeek_Data_Form_Element_Mediaurl');
        $element->addType('number', 'Clockworkgeek_Data_Form_Element_Number');
        $element->addType('url', 'Clockworkgeek_Data_Form_Element_Url');
        $element->addType('widget', 'Clockworkgeek_Data_Form_Element_Widget');
    }
}
