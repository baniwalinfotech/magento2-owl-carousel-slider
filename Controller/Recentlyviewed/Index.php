<?php

namespace Baniwal\OwlCarouselSlider\Controller\Recentlyviewed;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Json\Helper\Data;
use Psr\Log\LoggerInterface;
use Magento\Reports\Block\Product\Widget\Viewed\Proxy;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Baniwal\OwlCarouselSlider\Controller\Recentlyviewed
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var Data
     */
    protected $_jsonHelper;

    /**
     * @var LoggerInterface
     */
    protected $_logger;
    /**
     * @var Proxy
     */
    protected $_viewProductsBlock;
    /**
     * @var JsonFactory $resultJsonFactory
     */
    protected $resultJsonFactory;
    /**
     * @var RawFactory
     */
    protected $_resultRawFactory;

    protected $_resultPageFactory;


    /**
     * Index constructor.
     * @param Context $context
     * @param Data $jsonHelper
     * @param LoggerInterface $logger
     * @param Proxy $viewProductsBlock
     * @param JsonFactory $resultJsonFactory
     * @param RawFactory $resultRawFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Data $jsonHelper,
        LoggerInterface $logger,
        Proxy $viewProductsBlock,
        JsonFactory $resultJsonFactory,
        RawFactory $resultRawFactory,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_jsonHelper = $jsonHelper;
        $this->_logger = $logger;
        $this->_viewProductsBlock = $viewProductsBlock;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_resultRawFactory = $resultRawFactory;
        $this->_resultPageFactory = $resultPageFactory;
    }

    protected $resultFactory;

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $isAjax = false;
        $responseData = [];
        $params = $this->getRequest()->getParams();

        if (isset($params['is_ajax']) && $params['is_ajax']) {
            $isAjax = true;
        }

        $blockType = (isset($params['request_type']) && $params['request_type']) ? $params['request_type'] : false;

        if ($isAjax) {
            $isEmptyCollection = $this->isEmptyCollection();
            if($isEmptyCollection || !$blockType) {
                $responseData = [
                    'errors' => true
                ];
            } else {
                $layout = $this->_resultPageFactory->create();
                $block = $layout->getLayout()->createBlock('Baniwal\OwlCarouselSlider\Block\Slider\RecentProducts')
                    ->toHtml();

                $responseData = [
                    'errors' => false,
                    'block' => $block
                ];
            }
        }

        try {
            return $this->jsonResponse($responseData);
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return $this->jsonResponse($e->getMessage());
        } catch (\Exception $e) {
            $this->_logger->critical($e);
            return $this->jsonResponse($e->getMessage());
        }

    }

    /**
     * Create json response
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->_jsonHelper->jsonEncode($response)
        );
    }

    /**
     * @return bool
     */
    protected function isEmptyCollection()
    {
        $_collectionSize = $this->_viewProductsBlock->getItemsCollection()->getSize();
        if($_collectionSize < 1) {
            return true;
        }

        return false;
    }


}