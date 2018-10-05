<?php

namespace Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner;

/**
 * Banner Collection
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * _construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Baniwal\OwlCarouselSlider\Model\Banner',
            'Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner');
    }
}
