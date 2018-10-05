<?php

namespace Baniwal\OwlCarouselSlider\Controller\Adminhtml\Slider;

/**
 * Mass Status action
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class MassStatus extends \Baniwal\OwlCarouselSlider\Controller\Adminhtml\Slider
{
    /**
     * Dispatch request
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $sliderIds = $this->getRequest()->getParam('slider');
        $status = $this->getRequest()->getParam('status');
        
        if (!is_array($sliderIds) || empty($sliderIds)) {
            $this->messageManager->addError(__('Please select slider(s).'));
        } else {
            try {
                $sliderCollection = $this->_sliderCollectionFactory->create()
                    ->addFieldToFilter('id', ['in' => $sliderIds]);

                foreach ($sliderCollection as $slider) {
                    $slider->setStatus($status)
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 slider(s) status have been changed.', count($sliderIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
