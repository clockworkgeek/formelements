<?php

class Clockworkgeek_Formelements_Model_Output
{

    public function addProductAttributeHandlers(Varien_Event_Observer $observer)
    {
        $helper = $observer->getHelper();
        $helper->addHandler('productAttribute', $this);
    }

    public function productAttribute($helper, $html, $params)
    {
        $attributeName = @$params['attribute'];
        /* @var $product Mage_Catalog_Model_Product */
        $product = @$params['product'];
        if ($attributeName && $product) {
            $attributes = $product->getAttributes();
            /* @var $attribute Mage_Catalog_Model_Resource_Eav_Attribute */
            $attribute = @$attributes[$attributeName];
            if ($attribute) {
                switch ($attribute->getFrontendInput()) {
                    case 'mediaurl':
                        $html = $this->renderMediaImage($html);
                        break;
                    case 'widget':
                        $html = $this->renderWidget($html);
                        break;
                }
            }
        }
        return $html;
    }

    public function renderMediaImage($data)
    {
        if (preg_match('/^{{(?:media|skin) url="([^"]+)"}}$/', $data)) {
            $filename = Mage::getSingleton('formelements/template_localdir')->filter($data);
            $url = Mage::getSingleton('widget/template_filter')->filter($data);
            $imagesize = getimagesize($filename);
            if ($imagesize) {
                list($width, $height) = $imagesize;
                $data = sprintf('<img src="%s" width="%d" height="%d" />', $url, $width, $height);
            }
        }
        return $data;
    }

    public function renderWidget($data)
    {
        $template = Mage::getSingleton('widget/template_filter');
        return $template->filter($data);
    }
}
