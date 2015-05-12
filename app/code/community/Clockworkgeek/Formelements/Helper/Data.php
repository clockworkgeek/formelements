<?php

class Clockworkgeek_Formelements_Helper_Data extends Mage_Core_Helper_Data
{

    public function convertToDir($data)
    {
        return Mage::getSingleton('formelements/template_localdir')->filter($data);
    }

    public function convertToUrl($data)
    {
        return Mage::getSingleton('widget/template_filter')->filter($data);
    }
}
