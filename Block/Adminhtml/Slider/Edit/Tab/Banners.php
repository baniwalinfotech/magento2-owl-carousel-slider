<?php

namespace Baniwal\OwlCarouselSlider\Block\Adminhtml\Slider\Edit\Tab;

use Baniwal\OwlCarouselSlider\Model\Status;

/**
 * Banners tab.
 * @category Baniwal
 * @package  Baniwal_OwlCarouselSlider
 * @module   OwlCarouselSlider
 * @author   Baniwal Developer
 */
class Banners extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * banner factory.
     *
     * @var \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $_bannerCollectionFactory;

    /**
     * available status.
     *
     * @var \Baniwal\OwlCarouselSlider\Model\Status
     */
    private $_status;

    /**
     * [__construct description].
     *
     * @param \Magento\Backend\Block\Template\Context                                   $context
     * @param \Magento\Backend\Helper\Data                                              $backendHelper
     * @param \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory
     * @param \Baniwal\OwlCarouselSlider\Model\Status                                 $status
     * @param array                                                                     $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory,
        \Baniwal\OwlCarouselSlider\Model\Status $status,
        array $data = []
    ) {
        parent::__construct($context, $backendHelper, $data);

        $this->_bannerCollectionFactory = $bannerCollectionFactory;
        $this->_status = $status;
    }

    /**
     * _construct
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('bannerGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        if ($this->getRequest()->getParam('id')) {
            $this->setDefaultFilter(['in_banner' => 1]);
        }
    }

    /**
     * add Column Filter To Collection
     */
    protected function _addColumnFilterToCollection($column)
    {
        if ($column->getId() == 'in_banner') {
            $bannerIds = $this->_getSelectedBanners();

            if (empty($bannerIds)) {
                $bannerIds = 0;
            }

            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('id', ['in' => $bannerIds]);
            } else {
                if ($bannerIds) {
                    $this->getCollection()->addFieldToFilter('id', ['nin' => $bannerIds]);
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }

        return $this;
    }

    /**
     * prepare collection
     */
    protected function _prepareCollection()
    {
        /** @var \Baniwal\OwlCarouselSlider\Model\ResourceModel\Banner\Collection $collection */
        $collection = $this->_bannerCollectionFactory->create();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'in_banner',
            [
                'header_css_class' => 'a-center',
                'type'   => 'checkbox',
                'name'   => 'in_banner',
                'align'  => 'center',
                'index'  => 'id',
                'values' => $this->_getSelectedBanners(),
            ]
        );

        $this->addColumn(
            'id',
            [
                'header' => __('Banner ID'),
                'type'   => 'number',
                'index'  => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index'  => 'title',
                'class'  => 'xxx',
                'width'  => '50px',
            ]
        );
        $this->addColumn(
            'image',
            [
                'header' => __('Image'),
                'filter' => false,
                'width'  => '50px',
                'renderer' => 'Baniwal\OwlCarouselSlider\Block\Adminhtml\Banner\Helper\Renderer\Image',
            ]
        );
        $this->addColumn(
            'mobile_image',
            [
                'header' => __('Mobile Image'),
                'filter' => false,
                'width'  => '50px',
                'renderer' => 'Baniwal\OwlCarouselSlider\Block\Adminhtml\Banner\Helper\Renderer\MobileImage',
            ]
        );
        $this->addColumn(
            'title',
            [
                'header' => __('Banner Title'),
                'index'  => 'title',
                'width'  => '50px',
            ]
        );
        $this->addColumn(
            'valid_from',
            [
                'header' => __('Valid From'),
                'type'   => 'datetime',
                'index'  => 'valid_from',
                'width'  => '50px',
                'timezone' => true,
            ]
        );

        $this->addColumn(
            'valid_to',
            [
                'header' => __('Valid To'),
                'type'   => 'datetime',
                'index'  => 'valid_to',
                'width'  => '50px',
                'timezone' => true,
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index'  => 'status',
                'type'   => 'options',
                'filter_index' => 'main_table.status',
                'options' => $this->_status->getAllAvailableStatuses(),
            ]
        );

        $this->addColumn(
            'edit',
            [
                'header'   => __('Edit'),
                'filter'   => false,
                'sortable' => false,
                'index'    => 'stores',
                'renderer' => 'Baniwal\OwlCarouselSlider\Block\Adminhtml\Slider\Edit\Tab\Helper\Renderer\EditBanner',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $this->addColumn(
            'sort_order',
            [
                'header' => __('Sort Order'),
                'name'   => 'sort_order',
                'index'  => 'sort_order',
                'width'  => '50px',
                'editable' => true,
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/bannersgrid', ['_current' => true]);
    }

    /**
     * Get row url
     * @param  object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return '';
    }

    /**
     * Get selected slider banners
     * @return array
     */
    public function getSelectedSliderBanners()
    {
        $sliderId = $this->getRequest()->getParam('id');
        if (!isset($sliderId)) {
            return [];
        }
        $bannerCollection = $this->_bannerCollectionFactory->create();
        $bannerCollection->addFieldToFilter('slider_id', $sliderId);

        $bannerIds = [];
        foreach ($bannerCollection as $banner) {
            $bannerIds[$banner->getId()] = ['sort_order' => $banner->getSortOrder()];
        }

        return $bannerIds;
    }

    /**
     * Get selected banners
     * @return array|mixed
     */
    protected function _getSelectedBanners()
    {
        $banners = $this->getRequest()->getParam('banner');
        if (!is_array($banners)) {
            $banners = array_keys($this->getSelectedSliderBanners());
        }

        return $banners;
    }

    /**
     * Prepare label for tab.
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Banners');
    }

    /**
     * Prepare title for tab.
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Banners');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return true;
    }
}
