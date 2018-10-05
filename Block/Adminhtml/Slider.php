<?php

namespace Baniwal\OwlCarouselSlider\Block\Adminhtml;

/**
 * Slider grid container
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Slider extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Internal constructor, that is called from real constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'Baniwal_OwlCarouselSlider';
        $this->_headerText = __('Sliders');
        $this->_addButtonLabel = __('Add New Slider');
        
        parent::_construct();
    }
}
