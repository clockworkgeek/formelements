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

class Clockworkgeek_Formelements_Block_Adminhtml_Renderer_Fieldset_Element_Number
extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset_Element
{

    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        if (! ($element instanceof Clockworkgeek_Formelements_Block_Number)) {
            $number = new Clockworkgeek_Data_Form_Element_Number($element->getData());
            $number->setForm($element->getForm());
            $number->setId($element->getId());
            $element = $number;
        }
        return parent::render($element);
    }
}
