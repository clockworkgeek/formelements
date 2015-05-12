<?php

class Clockworkgeek_Formelements_Model_System_Config_Source_Widgettypes
{

    public function toOptionArray($withBlank = true)
    {
        $options = array();
        if ($withBlank) {
            $options[''] = array(
                'value' => '',
                'label' => Mage::helper('formelements')->__('-- Please Select --'),
                'description' => ''
            );
        }
        foreach (Mage::getModel('widget/widget')->getWidgetsArray() as $data) {
            $options[$data['type']] = array(
                'value' => $data['type'],
                'label' => $data['name'],
                'description' => $data['description']
            );
        }
        return $options;
    }

    public function toOptionHash($withBlank = true)
    {
        $options = array();
        if ($withBlank) {
            $options[''] = Mage::helper('formelements')->__('-- Please Select --');
        }
        foreach (Mage::getModel('widget/widget')->getWidgetsArray() as $data) {
            $options[$data['type']] = $data['name'];
        }
        return $options;
    }
}
