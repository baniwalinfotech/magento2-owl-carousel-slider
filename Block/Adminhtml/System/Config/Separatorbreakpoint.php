<?php

namespace Baniwal\OwlCarouselSlider\Block\Adminhtml\System\Config;

/**
 * Implement
 * @category Baniwal_OwlCarouselSlider
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal_OwlCarouselSlider Developer
 */
class Separatorbreakpoint extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $number = (int)substr($element->getId(), -1);

        if($number > 0) {
            $html = '
                <p style="text-align: center;"><strong >' . __('Breakpoint ') . $number . '</strong></p>
            ';
        } else {
            $html = '
            <div class="message" style="text-align: center; margin-top: 20px;">
                <p><strong>' . __('Breakpoint Carousel Options') . '</strong></p>
                <p><strong>' . __('This configuration will overwrite the General Carousel Options.') . '</strong></p>
            </div>
        ';
        }

        return $html;
    }
}
