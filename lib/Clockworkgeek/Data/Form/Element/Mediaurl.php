<?php
class Clockworkgeek_Data_Form_Element_Mediaurl
extends Varien_Data_Form_Element_Abstract
{

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        // needs anything in ext_type to enable "Use Default Value" checkbox
        $this->setExtType('image');
    }

    public function getElementHtml()
    {
        $url = Mage::getSingleton('adminhtml/url')->getUrl(
            'adminhtml/cms_wysiwyg_images/index', array(
                'target_element_id' => $this->getHtmlId()
            )
        );
        $thumbnailUrl = Mage::getUrl('adminhtml/cms_wysiwyg_images/thumbnail');
        $helper = Mage::helper('formelements');

        $htmlId = $this->getHtmlId();
        $html = "<input id='{$htmlId}' name='{$this->getName()}' value='{$this->getEscapedValue()}' type='hidden' />";

        $browseLabel = $helper->__('Set Image...');
        $disabled = $this->getReadonly() || $this->getDisabled() ? ' disabled' : '';
        $disabledAttr = $disabled ? ' disabled="disabled"' : '';
        $html .= "<button class='add-image{$disabled}' style='margin:0 5px 5px 0;' onclick=\"MediabrowserUtility.openDialog('{$url}', false, false, '{$browseLabel}'); return false;\"{$disabledAttr}><span>{$browseLabel}</span></button>";

        $removeLabel = $helper->__('Clear Image');
        $html .= "<button class='delete{$disabled}' onclick=\"clearMediaUrl('{$htmlId}'); return false;\"{$disabledAttr}><span>{$removeLabel}</span></button>";

        $html .= "<div id='{$this->getHtmlId()}_preview'>";
        if (preg_match('/{{media url="wysiwyg\/([^"]+)"}}/', $this->getValue(), $match)) {
            $previewUrl = Mage::getUrl(
                'adminhtml/cms_wysiwyg_images/thumbnail',
                array(
                    'file' => $helper->urlEncode($match[1])
                )
            );
            $html .= "<img src='{$previewUrl}' alt='{$match[1]}' />";
        }
        $html .= "</div>";
        $html .= "<script type='text/javascript'>watchMediaUrl('{$htmlId}', '{$thumbnailUrl}');</script>";
        return $html;
    }
}
