<?php

class Clockworkgeek_Data_Form_Element_Widget
extends Varien_Data_Form_Element_Abstract
{

    public function getElementHtml()
    {
        $params = $this->getValueParameters();

        $html = '<input id="'.$this->getHtmlId().'" name="'.$this->getName()
        .'" value="'.$this->getEscapedValue().'" type="hidden"/>'."\n";

        /* @var $typeForm Clockworkgeek_Formelements_Block_Adminhtml_Widget_Form */
        $typeForm = Mage::app()->getLayout()->createBlock('formelements/adminhtml_widget_form');
        $typeForm->setDisabled($this->getDisabled());
        $typeForm->setId($this->getId());
        $typeForm->setRequired($this->getRequired());
        $typeForm->setWidgetType(@$params['type']);
        if ($this->getForm()) {
            $typeForm->setFieldNameSuffix($this->getForm()->getFieldNameSuffix());
        }
        $html .= $typeForm->toHtml();

        $optionsHtml = $this->_getWidgetOptionshtml();
        $html .= "<div id='{$this->getHtmlId()}_options'>{$optionsHtml}</div>";
        return $html . $this->getAfterElementHtml();
    }

    public function getValueParameters()
    {
        if (preg_match('/{{widget(.*?)}}/si', $this->getValue(), $directive)) {
            $tokenizer = new Varien_Filter_Template_Tokenizer_Parameter();
            $tokenizer->setString($directive[1]);
            return $tokenizer->tokenize();
        }
        return array();
    }

    protected function _getWidgetOptionsHtml()
    {
        $params = $this->getValueParameters();

        if (isset($params['type'])) {
            /* @var $options Clockworkgeek_Formelements_Block_Adminhtml_Widget_Options */
            $options = Mage::app()->getLayout()->createBlock('formelements/adminhtml_widget_options');
            $options->setDisabled($this->getDisabled());
            $options->setWidgetType($params['type']);
            $options->setWidgetValues($params);
            $optionsId = $this->getHtmlId().'_options_'.strtr($params['type'], '/', '_');
            return "<div id='{$optionsId}'>{$options->toHtml()}</div>";
        }
        return '';
    }
}
