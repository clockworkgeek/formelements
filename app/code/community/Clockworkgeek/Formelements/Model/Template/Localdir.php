<?php

class Clockworkgeek_Formelements_Model_Template_localdir extends Mage_Core_Model_Email_Template_Filter
{

    public function mediaDirective($construction)
    {
        $params = $this->_getIncludeParameters($construction[2]);
        return Mage::getBaseDir('media') . DS . @$params['url'];
    }

    public function skinDirective($construction)
    {
        $skinUrl = parent::skinDirective($construction);
        return str_replace(Mage::getBaseUrl(), Mage::getBaseDir().DS, $skinUrl);
    }
}
