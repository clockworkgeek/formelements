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
