<?php

class Clockworkgeek_Formelements_Block_Template extends Mage_Core_Block_Template
{

    protected function _toHtml()
    {
        $html = parent::_toHtml();
        $filter = Mage::getSingleton('widget/template_filter');
        return $filter->filter($html);
    }
}
