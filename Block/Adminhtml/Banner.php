<?php

namespace Baniwal\OwlCarouselSlider\Block\Adminhtml;

/**
 * Banner grid container
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Banner extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Internal constructor, that is called from real constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_banner';
        $this->_blockGroup = 'Baniwal_OwlCarouselSlider';
        $this->_headerText = __('Banners');
        $this->_addButtonLabel = __('Add New Banner');

        parent::_construct();
    }
}
