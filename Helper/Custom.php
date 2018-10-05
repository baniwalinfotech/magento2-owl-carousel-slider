<?php

namespace Baniwal\OwlCarouselSlider\Helper;

/**
 * Helper Custom Slider
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Custom extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Slider factory.
     *
     * @var \Baniwal\OwlCarouselSlider\Model\Slider
     */
    protected $_sliderModel;

    protected $_configFieldsSlider;

    protected $_configFieldsBanner;

    protected $_sliderId;

    protected $_date;

    protected $_scopeConfig;

    /**
     * @param \Magento\Framework\App\Helper\Context              $context
     * @param \Baniwal\OwlCarouselSlider\Model\Slider          $sliderModel
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Baniwal\OwlCarouselSlider\Model\Slider $sliderModel,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        parent::__construct($context);

        $this->_sliderModel = $sliderModel;
        $this->_date        = $date;
        $this->_scopeConfig = $context->getScopeConfig();
    }

    /**
     * Retrieve the slider config options.
     *
     * @param $sliderId
     * @return \Magento\Framework\DataObject
     */
    public function getSliderConfigOptions($sliderId)
    {
        if($this->_sliderId != $sliderId && is_null($this->_configFieldsSlider)) {

            $this->_sliderId = $sliderId;

            $this->_configFieldsSlider = [
                'title',
                'show_title',
                'status',
                'nav',
                'dots',
                'center',
                'items',
                'loop',
                'margin',
                'merge',
                'URLhashListener',
                'stagePadding',
                'lazyLoad',
                'transition',
                'autoplay',
                'autoplayTimeout',
                'autoplayHoverPause',
                'autoHeight',
                'nav_brk1',
                'items_brk1',
                'nav_brk2',
                'items_brk2',
                'nav_brk3',
                'items_brk3',
                'nav_brk4',
                'items_brk4',
            ];
        }
        if(is_null($this->_configFieldsBanner)) {
            $this->_configFieldsBanner = [
                'id',
                'title',
                'show_title',
                'description',
                'show_description',
                'status',
                'url',
                'banner_type',
                'image',
                'video',
                'custom',
                'alt_text',
                'target',
                'button_text',
                'custom_content',
                'custom_css',
                'valid_from',
                'valid_to',
                'ga_promo_id',
                'ga_promo_name',
                'ga_promo_creative',
                'ga_promo_position'
            ];
        }

        /* @var \Baniwal\OwlCarouselSlider\Model\Slider $slider */
        $slider = $this->_sliderModel->load($sliderId);

        if (!count($this->_configFieldsSlider)) {
            return new \Magento\Framework\DataObject();
        }

        $sliderConfig = [];
        foreach ($this->_configFieldsSlider as $field) {
            $sliderConfig[$field] = $slider->getData($field);
        }

        $sliderBannersCollection = $slider->getSliderBanerCollection();
        $sliderBannersCollection->setOrder('sort_order', 'ASC');

        $bannerConfig = [];
        foreach ($sliderBannersCollection as $banner) {

            if (!$this->validateBannerDisplayDate($banner) || !$banner->getStatus()) {
                continue;
            }

            $bannerDetails = [];
            foreach ($this->_configFieldsBanner as $field) {
                $bannerDetails[$field] = $banner->getData($field);
            }
            $bannerConfig[$banner->getId()] = $bannerDetails;
        }

        $configData = new \Magento\Framework\DataObject();

        $configData->setSliderConfig($sliderConfig);
        $configData->setBannerConfig($bannerConfig);

        return $configData;
    }

    /**
     * @param $sortOrder
     * @param $banners
     * @return mixed
     */
    private function _incrementSortOrder($sortOrder, $banners)
    {
        $sortOrder++;
        if (array_key_exists($sortOrder, $banners)) {
            $sortOrder = $this->_incrementSortOrder($sortOrder, $banners);
        }

        return $sortOrder;
    }

    /**
     * Retrieve the breakpoint configuration.
     * 
     * @return array
     */
    public function getBreakpointConfiguration()
    {
        $configPaths = [
            'breakpoint_1',
            'breakpoint_2',
            'breakpoint_3',
            'breakpoint_4',
        ];

        $breakpointConfiguration = [];

        foreach ($configPaths as $configPath) {
            $value = $this->_getConfigValue($configPath);
            $breakpointConfiguration[$configPath] = $value ? $value : 0;
        }

        return $breakpointConfiguration;
    }

    /**
     * Retrieve the breakpoint configuration.
     *
     * @return array
     */
    public function getDisplaySocial()
    {
        $configPaths = [
            'display_wishlist',
            'display_compare'
        ];

        $displaySocial = [];

        foreach ($configPaths as $configPath) {
            $value = $this->_getConfigValue($configPath);
	        $displaySocial[$configPath] = $value ? $value : 0;
        }

        return $displaySocial;
    }

    /**
     * Retrieve the config value.
     *
     * @param string $configPath
     * @return mixed
     */
    private function _getConfigValue($configPath)
    {
        $sysPath = 'baniwal_owl_carousel_config/general/' . $configPath;

        return $this->_scopeConfig->getValue($sysPath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Validate the banner display date.
     *
     * @param \Baniwal\OwlCarouselSlider\Model\Banner $banner
     * @return bool
     */
    public function validateBannerDisplayDate($banner)
    {
        $validFrom = $banner->getValidFrom();
        $validTo   = $banner->getValidTo();

        $now = $this->_date->gmtDate();

        if ($validFrom <= $now && $validTo >= $now) {
            return true;
        }

        return false;
    }

    public function isGatEnabled()
    {
        $sysPath = 'baniwal_owl_slider_config/general/enable_google_tracking';
        return $this->_scopeConfig->getValue($sysPath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function isHoverImageEnabled() {
        return false;
    }
}
