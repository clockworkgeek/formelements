<?php

/**
 * @method boolean getDisabled()
 * @method string getWidgetType()
 * @method void setDisabled(bool)
 * @method void setWidgetType(string)
 */
class Clockworkgeek_Formelements_Block_Adminhtml_Widget_Options extends Mage_Widget_Block_Adminhtml_Widget_Options
{

    protected function _addField($parameter)
    {
        $field = parent::_addField($parameter);
        if ($this->getDisabled()) {
            $field->setDisabled(true);
        }
        // else do not enable an already disabled field
        return $field;
    }
}
