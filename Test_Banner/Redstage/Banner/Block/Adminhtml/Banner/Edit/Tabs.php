<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */
namespace Redstage\Banner\Block\Adminhtml\Banner\Edit;

/**
 * Class Tabs
 * @package Redstage\Banner\Block\Adminhtml\Banner\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * Initialize banner edit page tabs
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('banner_info_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Banner Information'));
    }
}
