<?php

namespace Baniwal\OwlCarouselSlider\Model\ResourceModel;

/**
 * Slider Resource Model
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Slider extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init('baniwal_owlcarouselslider_sliders', 'id');
    }
}
