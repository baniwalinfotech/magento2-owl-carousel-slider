<?php

namespace Baniwal\OwlCarouselSlider\Model;

/**
 * Banner Model
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Banner extends \Magento\Framework\Model\AbstractModel
{
    const OWLCAROUSELSLIDER_MEDIA_PATH = 'baniwal/owlcarouselslider/images';

    /**
     * slider colleciton factory.
     *
     * @var \Baniwal\OwlCarouselSlider\Model\ResourceModel\Slider\CollectionFactory
     */
    protected $_sliderCollectionFactory;

    /**
     * [$_formFieldHtmlIdPrefix description].
     *
     * @var string
     */
    protected $_formFieldHtmlIdPrefix = 'page_';

    /**
     * logger.
     *
     * @var \Magento\Framework\Logger\Monolog
     */
    protected $_monolog;

    protected $_bannerFactory;

    /**
     * [__construct description].
     *
     * @param \Magento\Framework\Model\Context                                          $context
     * @param \Magento\Framework\Registry                                               $registry
     * @param \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner                   $resource
     * @param \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\Collection        $resourceCollection
     * @param \Baniwal\OwlCarouselSlider\Model\BannerFactory                          $bannerFactory
     * @param \Baniwal\OwlCarouselSlider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory
     * @param \Magento\Store\Model\StoreManagerInterface                                $storeManager
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner $resource,
        \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\Collection $resourceCollection,
        \Baniwal\OwlCarouselSlider\Model\BannerFactory $bannerFactory,
        \Baniwal\OwlCarouselSlider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Logger\Monolog $monolog
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection);

        $this->_bannerFactory = $bannerFactory;
        $this->_sliderCollectionFactory = $sliderCollectionFactory;
        $this->_monolog = $monolog;
    }

    /**
     * Return the form field html id prefix.
     *
     * @return string
     */
    public function getFormFieldHtmlIdPrefix()
    {
        return $this->_formFieldHtmlIdPrefix;
    }

    /**
     * Return the available sliders.
     *
     * @return []
     */
    public function getAvailableSliders()
    {
        $option[] = [
            'value' => '',
            'label' => __('--- Please select a slider ---'),
        ];

        $sliders = $this->_sliderCollectionFactory->create();

        if(count($sliders)) {
            foreach ($sliders as $slider) {
                $option[] = [
                    'value' => $slider->getId(),
                    'label' => $slider->getTitle(),
                ];
            }
        }

        return $option;
    }

    /**
     * Return the available banners type.
     *
     * @return []
     */
    public function getAvailableBannerType()
    {
        $options = [];
        $options[] = [
            'value' => 1,
            'label' => __('Image'),
        ];
        $options[] = [
            'value' => 2,
            'label' => __('Video'),
        ];
        $options[] = [
            'value' => 3,
            'label' => __('Custom'),
        ];


        return $options;
    }
}