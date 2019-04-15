<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */

namespace Redstage\Banner\Controller\Adminhtml\Banner;

/**
 * Class Edit
 * @package Redstage\Banner\Controller\Adminhtml\Banner
 */
class Edit extends \Redstage\Banner\Controller\Adminhtml\Banner
{
    /**
     * Edit action
     *
     * @return void
     */
    public function execute()
    {
        $bannerId = $this->getRequest()->getParam('id');
        $model = $this->initBanner('id');

        if (!$model->getId() && $bannerId) {
            $this->messageManager->addError(__('This banner no longer exists.'));
            $this->_redirect('adminhtml/*/');
            return;
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        $this->_view->loadLayout();
        $this->_setActiveMenu('Magento_Banner::cms_magento_banner');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Banners'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $model->getId() ? $model->getName() : __('New Banner')
        );

        $this->_addBreadcrumb(
            $bannerId ? __('Edit Banner') : __('New Banner'),
            $bannerId ? __('Edit Banner') : __('New Banner')
        );
        $this->_view->renderLayout();
    }
}
