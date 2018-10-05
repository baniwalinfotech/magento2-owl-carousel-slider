<?php

namespace Baniwal\OwlCarouselSlider\Model\ResourceModel;

/**
 * Banner Resource Model
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init('baniwal_owlcarouselslider_banners', 'id');
    }
}
