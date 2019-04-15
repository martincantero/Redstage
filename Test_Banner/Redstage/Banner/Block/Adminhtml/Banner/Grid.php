<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */
namespace Redstage\Banner\Block\Adminhtml\Banner;

/**
 * Class Grid
 * @package Redstage\Banner\Block\Adminhtml\Banner
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Banner resource collection factory
     *
     * @var \Redstage\Banner\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $_bannerColFactory = null;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Redstage\Banner\Model\ResourceModel\Banner\CollectionFactory $bannerColFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Redstage\Banner\Model\ResourceModel\Banner\CollectionFactory $bannerColFactory,
        array $data = []
    ) {
        parent::__construct($context, $backendHelper, $data);
        $this->_bannerColFactory = $bannerColFactory;
    }

    /**
     * Set defaults
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('bannerGrid');
        $this->setDefaultSort('banner_id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('banner_filter');
    }

    /**
     * Instantiate and prepare collection
     *
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_bannerColFactory->create()->addStoresVisibility();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Define grid columns
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'banner_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'banner_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );

        $this->addColumn(
            'name',
            ['header' => __('Name'), 'type' => 'text', 'index' => 'name', 'escape' => true]
        );

        $this->addColumn(
            'title',
            ['header' => __('Title'), 'type' => 'text', 'index' => 'title', 'escape' => true]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'align' => 'center',
                'width' => 1,
                'index' => 'status',
                'type' => 'options',
                'options' => [
                    \Redstage\Banner\Model\Banner::STATUS_ENABLED => __('Active'),
                    \Redstage\Banner\Model\Banner::STATUS_DISABLED => __('Inactive'),
                ]
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * Prepare mass action options for this grid
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('banner_id');
        $this->getMassactionBlock()->setFormFieldName('banner');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('adminhtml/*/massDelete'),
                'confirm' => __('Are you sure you want to delete these banners?')
            ]
        );

        return $this;
    }

    /**
     * Grid row URL getter
     *
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('adminhtml/*/edit', ['id' => $row->getBannerId()]);
    }

    /**
     * Define row click callback
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('adminhtml/*/grid', ['_current' => true]);
    }

}
