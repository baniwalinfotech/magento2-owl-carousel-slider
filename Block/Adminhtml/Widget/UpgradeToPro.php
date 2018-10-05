<?php
namespace Baniwal\OwlCarouselSlider\Block\Adminhtml\Widget;

/**
 * Class UpgradeToPro
 * @package Baniwal\OwlCarouselSlider\Block\Adminhtml\Widget
 */
class UpgradeToPro extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Prepare chooser element HTML
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element Form Element
     * @return \Magento\Framework\Data\Form\Element\AbstractElement
     */
    public function prepareElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $upgradeText = __('');
        $element->setData('after_element_html', $upgradeText);
        return $element;
    }
}
