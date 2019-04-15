<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */

namespace Redstage\Banner\Block\Adminhtml;

/**
 * Class Banner
 * @package Redstage\Banner\Block\Adminhtml
 */
class Banner extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_banner';
        $this->_blockGroup = 'Redstage_Banner';
        $this->_headerText = __('Banner');
        $this->_addButtonLabel = __('Create New Banner');
        parent::_construct();
    }
}
