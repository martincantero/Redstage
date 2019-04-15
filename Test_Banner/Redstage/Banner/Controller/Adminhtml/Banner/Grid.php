<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */

namespace Redstage\Banner\Controller\Adminhtml\Banner;

/**
 * Class Grid
 * @package Redstage\Banner\Controller\Adminhtml\Banner
 */
class Grid extends \Redstage\Banner\Controller\Adminhtml\Banner
{
    /**
     * Render Banner grid
     *
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
