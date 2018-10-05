<?php

namespace Baniwal\OwlCarouselSlider\Controller\Adminhtml\Slider;

/**
 * Banners of slider action
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Banners extends \Baniwal\OwlCarouselSlider\Controller\Adminhtml\Slider
{
    /**
     * Dispatch request
     */
    public function execute()
    {
        $resultLayout = $this->_resultLayoutFactory->create();
        
        $resultLayout
            ->getLayout()->getBlock('owlcarouselslider.slider.edit.tab.banners')
            ->setInBanner($this->getRequest()->getPost('banner', null));

        return $resultLayout;
    }
}
