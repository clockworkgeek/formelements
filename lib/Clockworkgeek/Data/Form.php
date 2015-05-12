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

class Clockworkgeek_Data_Form extends Varien_Data_Form
{

    protected function _construct()
    {
        parent::_construct();
        $this->_updateTypes($this);
    }

    public function addElement(Varien_Data_Form_Element_Abstract $element, $after = null)
    {
        // only updates immediate children, what about nested fieldsets?
        $this->_updateTypes($element);
        return parent::addElement($element, $after);
    }

    /**
     * Force own types on $element
     * 
     * @param Varien_Data_Form_Element_Abstract $element
     */
    protected function _updateTypes(Varien_Data_Form_Abstract $element)
    {
        $element->addType('color', 'Clockworkgeek_Data_Form_Element_Color');
        $element->addType('email', 'Clockworkgeek_Data_Form_Element_Email');
        $element->addType('mediaurl', 'Clockworkgeek_Data_Form_Element_Mediaurl');
        $element->addType('number', 'Clockworkgeek_Data_Form_Element_Number');
        $element->addType('url', 'Clockworkgeek_Data_Form_Element_Url');
        $element->addType('widget', 'Clockworkgeek_Data_Form_Element_Widget');
    }
}
