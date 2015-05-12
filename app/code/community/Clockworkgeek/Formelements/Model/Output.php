<?php
/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Daniel Deady
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

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
