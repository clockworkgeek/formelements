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
 * @method boolean getRequired()
 * @method boolean getDisabled()
 * @method string getWidgetType()
 * @method Clockworkgeek_Formelements_Block_Adminhtml_Widget_Form setDisabled(boolean)
 * @method Clockworkgeek_Formelements_Block_Adminhtml_Widget_Form setRequired(boolean)
 * @method Clockworkgeek_Formelements_Block_Adminhtml_Widget_Form setWidgetType(string)
 */
class Clockworkgeek_Formelements_Block_Adminhtml_Widget_Form extends Mage_Widget_Block_Adminhtml_Widget_Form
{

    protected function _prepareForm()
    {
        parent::_prepareForm();
        $form = $this->getForm();
        $form->setUseContainer(false);
        $form->setHtmlId($this->getHtmlId() . '_form');

        $select = $form->getElement('select_widget_type');
        $select->setDisabled($this->getDisabled());
        $select->setHtmlId($this->getHtmlId() . '_type');
        $select->setRequired($this->getRequired());
        $select->setValue($this->getWidgetType());

        return $this;
    }

    /**
     * Prepare widgets select after element HTML
     *
     * @return string
     */
    protected function _getWidgetSelectAfterHtml()
    {
        $html = '';
        $selected = '';
        $i = 0;
        foreach ($this->_getAvailableWidgets(true) as $data) {
            $html .= sprintf('<div id="widget-description-%s" class="no-display">%s</div>', $i, $data['description']);
            if ($data['type'] == $this->getWidgetType()) {
                $selected = $data['description'];
            }
            $i++;
        }
        $html = sprintf('<p class="nm"><small>%s</small></p>%s', $selected, $html);

        $optionsUrl = $this->getUrl('*/widget/loadOptions');
        // TODO move inline JS to 'js' block or template or both
        // TODO convert complex fields into comma separated strings
        $htmlId = $this->getHtmlId();
        $html .=
<<<HTML
<script type="text/javascript">
document.observe('dom:loaded', function() {
  {$htmlId}Widget = new WysiwygWidget.Widget("{$this->getFormId()}", "{$htmlId}_type",
  "{$htmlId}_options", "{$optionsUrl}", "{$htmlId}");
  varienGlobalEvents.attachEventHandler('formSubmit', function(formId) {
    var widgetType = \$F('{$htmlId}_type');
    if (!widgetType) {
        Form.Element.setValue('{$htmlId}', '');
        return;
    }

    var optionsDiv = $('{$htmlId}_options_'+widgetType.replace('/', '_')),
            fields = optionsDiv.select('input,select,textarea'),
         directive = '{{widget type="'+widgetType+'"';
    fields.each(function(field) {
      var key = field.name.replace(/^parameters\[([^\]]+)\]$/, '$1'),
        value = \$F(field).replace(/"/g, '\\"');
      if (value) {
        directive += ' ' + key + '="' + value + '"';
      }
    });
    directive += '}}';
    Form.Element.setValue('{$htmlId}', directive);
  });
});
</script>
HTML;

        return $html;
    }

    public function getFormId()
    {
        $id = '';
        if ($this->getFieldNameSuffix()) {
            $id = $this->getFieldNameSuffix() . '_';
        }
        return $id . $this->getDestElementId();
    }
}
