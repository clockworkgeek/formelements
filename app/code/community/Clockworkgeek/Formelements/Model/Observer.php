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

class Clockworkgeek_Formelements_Model_Observer
{

    public function addProductAttributeTypes(Varien_Event_Observer $observer)
    {
        $helper = Mage::helper('formelements');
        $response = $observer->getResponse();
        $types = $response->getTypes();
        $types[] = array(
            'value' => 'color',
            'label' => $helper->__('HTML Color'),
            'hide_fields' => array(
                'is_filterable',
                'is_filterable_in_search',
                'position',
                'frontend_class'
            )
        );
        $types[] = array(
            'value' => 'color',
            'label' => $helper->__('HTML Email'),
            'hide_fields' => array(
                'is_filterable',
                'is_filterable_in_search',
                'position',
                'frontend_class'
            )
        );
        $types[] = array(
            'value' => 'number',
            'label' => $helper->__('HTML Number'),
            'hide_fields' => array(
                'is_filterable',
                'is_filterable_in_search',
                'position',
                'frontend_class'
            )
        );
        $types[] = array(
            'value' => 'color',
            'label' => $helper->__('HTML Url'),
            'hide_fields' => array(
                'is_filterable',
                'is_filterable_in_search',
                'position',
                'frontend_class'
            )
        );

        // complex display types, cannot be used for data driven features
        $types[] = array(
            'value' => 'mediaurl',
            'label' => $helper->__('WYSIWYG Media File'),
            'hide_fields' => array(
                'is_unique',
                'is_searchable',
                'is_visible_in_advanced_search',
                'is_comparable',
                'is_filterable',
                'is_filterable_in_search',
                'is_used_for_promo_rules',
                'position',
                'used_for_sort_by',
                'frontend_class'
            )
        );
        $types[] = array(
            'value' => 'widget',
            'label' => $helper->__('Widget'),
            'hide_fields' => array(
                'is_unique',
                'is_searchable',
                'is_visible_in_advanced_search',
                'is_comparable',
                'is_filterable',
                'is_filterable_in_search',
                'is_used_for_promo_rules',
                'position',
                'used_for_sort_by',
                'frontend_class'
            )
        );
        $response->setTypes($types);
    }

    public function addProductAttributeElements(Varien_Event_Observer $observer)
    {
        $response = $observer->getResponse();
        $types = $response->getTypes();
        $types['color'] = 'Clockworkgeek_Data_Form_Element_Color';
        $types['email'] = 'Clockworkgeek_Data_Form_Element_Email';
        $types['number'] = 'Clockworkgeek_Data_Form_Element_Number';
        $types['url'] = 'Clockworkgeek_Data_Form_Element_Url';
        $types['mediaurl'] = 'Clockworkgeek_Data_Form_Element_Mediaurl';
        $types['widget'] = 'Clockworkgeek_Data_Form_Element_Widget';
        $response->setTypes($types);
    }

    public function setAttributeBackendType(Varien_Event_Observer $observer)
    {
        $attribute = $observer->getAttribute();
        switch ($attribute->getFrontendInput()) {
            case 'number':
                $attribute->setBackendType('decimal');
                break;
            case 'color':
            case 'email':
            case 'url':
            case 'mediaurl':
            case 'widget':
                $attribute->setBackendType('varchar');
                break;
        }
    }
}
