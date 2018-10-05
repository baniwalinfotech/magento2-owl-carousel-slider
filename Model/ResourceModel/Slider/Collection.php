<?php

namespace Baniwal\OwlCarouselSlider\Model\ResourceModel\Slider;

/**
 * Slider Collection
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * _contruct
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Baniwal\OwlCarouselSlider\Model\Slider',
            'Baniwal\OwlCarouselSlider\Model\ResourceModel\Slider');
    }
}
