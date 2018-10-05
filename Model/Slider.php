<?php

namespace Baniwal\OwlCarouselSlider\Model;

/**
 * Slider Model
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Slider extends \Magento\Framework\Model\AbstractModel
{
    const SLIDER_TYPE_CONFIGURABLE  = 1;
    const SLIDER_TYPE_CUSTOM        = 2;

    const XML_CONFIG_ENABLE_BANNER = 'baniwal_owl_carouselslider_general/general/enable_owlcarousel';

    /**
     * banner collection factory.
     *
     * @var \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $_bannerCollectionFactory;

    /**
     * constructor.
     *
     * @param \Magento\Framework\Model\Context                                          $context
     * @param \Magento\Framework\Registry                                               $registry
     * @param \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory
     * @param \Baniwal\OwlCarouselSlider\Model\ResourceModel\Slider                   $resource
     * @param \Baniwal\OwlCarouselSlider\Model\ResourceModel\Slider\Collection        $resourceCollection
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory,
        \Baniwal\OwlCarouselSlider\Model\ResourceModel\Slider $resource,
        \Baniwal\OwlCarouselSlider\Model\ResourceModel\Slider\Collection $resourceCollection
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection);

        $this->_bannerCollectionFactory = $bannerCollectionFactory;
    }

    /**
     * Retrieve available slider type.
     *
     * @return []
     */
    public static function getAvailableTransition()
    {
        return [
            'slide'   => __('Slide'),
            'fadeOut' => __('Fade'),
        ];
    }

    /**
     * Retrieve banner collection of slider.
     *
     * @return \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\Collection
     */
    public function getSliderBanerCollection()
    {
        return $this->_bannerCollectionFactory->create()->addFieldToFilter('slider_id', $this->getId());
    }
}
