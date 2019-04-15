<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */

namespace Redstage\Banner\Controller\Adminhtml\Banner;

/**
 * Class NewAction
 * @package Redstage\Banner\Controller\Adminhtml\Banner
 */
class NewAction extends \Redstage\Banner\Controller\Adminhtml\Banner
{
    /**
     * Create new banner
     *
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
