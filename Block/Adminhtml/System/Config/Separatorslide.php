<?php

namespace Baniwal\OwlCarouselSlider\Block\Adminhtml\System\Config;

/**
 * Implement
 * @category Baniwal_OwlCarouselSlider
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal_OwlCarouselSlider Developer
 */
class Separatorslide extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $html = '
            <div class="message" style="text-align: center; margin-top: 20px;">
                <strong>' . __('General Carousel Options') . '</strong><br />
            </div>
        ';

        return $html;
    }
}
