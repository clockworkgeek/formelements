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

/**
 * Use instead of core/template and cms directives will be transformed for you.
 * 
 * Remember to <code>setCacheLifetime()</code> to take advantage of smart caching.
 */
class Clockworkgeek_Formelements_Block_Template extends Mage_Core_Block_Template
{

    protected function _toHtml()
    {
        $html = parent::_toHtml();
        $filter = Mage::getSingleton('cms/template_filter');
        $html = $filter->filter($html);
        // process widgets separately
        $html = $this->filterWidgetDirectives($html);
        return $html;
    }

    /**
     * Collect widget cache tags and claim them as own.
     * 
     * Contained widgets are never child blocks nor declared in layout
     * and that makes it difficult for FPC solutions to hole punch.
     * By processing widgets manually we can mimic their cache tags
     * which is important for dynamic content.
     * 
     * @param string $html
     * @return string
     */
    public function filterWidgetDirectives($html)
    {
        $pattern = '/{{widget\b(.*?)}}/si';

        $html = preg_replace_callback($pattern, function ($construction) {
            $tokenizer = new Varien_Filter_Template_Tokenizer_Parameter();
            $tokenizer->setString($construction[1]);
            $params = $tokenizer->tokenize();

            // Copied from Mage_Widget_Model_Template_Filter::widgetDirective...
            // Determine what name block should have in layout
            $name = null;
            if (isset($params['name'])) {
                $name = $params['name'];
            }
            
            // validate required parameter type or id
            if (!empty($params['type'])) {
                $type = $params['type'];
            } elseif (!empty($params['id'])) {
                $preconfigured = Mage::getResourceSingleton('widget/widget')
                ->loadPreconfiguredWidget($params['id']);
                $type = $preconfigured['widget_type'];
                $params = $preconfigured['parameters'];
            } else {
                return '';
            }
            
            // we have no other way to avoid fatal errors for type like 'cms/widget__link', '_cms/widget_link' etc.
            $xml = Mage::getSingleton('widget/widget')->getXmlElementByType($type);
            if ($xml === null) {
                return '';
            }
            
            // define widget block and check the type is instance of Widget Interface
            $widget = Mage::app()->getLayout()->createBlock($type, $name, $params);
            if (!$widget instanceof Mage_Widget_Block_Interface) {
                return '';
            }

            $tags = array_unique(array_merge(
                $this->getCacheTags(),
                $widget->getCacheTags()
            ));
            $this->setData(self::CACHE_TAGS_DATA_KEY, $tags);

            return $widget->toHtml();
        }, $html);

        return $html;
    }
}
