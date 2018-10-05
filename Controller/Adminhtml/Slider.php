<?php

namespace Baniwal\OwlCarouselSlider\Controller\Adminhtml;

/**
 * Slider Abstract Action
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
abstract class Slider extends \Baniwal\OwlCarouselSlider\Controller\Adminhtml\AbstractAction
{
    const PARAM_ID = 'id';

    /**
     * Check if admin has permissions to visit slider pages.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Baniwal_OwlCarouselSlider::owlcarouselslider_custom_sliders');
    }
}
