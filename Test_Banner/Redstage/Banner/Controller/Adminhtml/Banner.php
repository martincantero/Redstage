<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */

namespace Redstage\Banner\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Redstage\Banner\Model\BannerFactory;

/**
 * Class Banner
 * @package Redstage\Banner\Controller\Adminhtml
 */
abstract class Banner extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Redstage_Banner::redstage_banner';

    /**
     * Banner Factory
     *
     * @var BannerFactory
     */
    protected $_bannerFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_registry = null;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        BannerFactory $bannerFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $registry
    )
    {
        $this->_bannerFactory = $bannerFactory;
        $this->_registry = $registry;
        parent::__construct($context);
    }

    /**
     * Init Banner
     *
     * @return \Redstage\Banner\Model\Banner
     */
    protected function initBanner()
    {
        $bannerId = (int)$this->getRequest()->getParam('banner_id');
        /** @var \Redstage\Banner\Model\Banner $banner */
        $banner = $this->_bannerFactory->create();
        if ($bannerId) {
            $banner->load($bannerId);
        }
        $this->_registry->register('current_rsbanner', $banner);

        return $banner;
    }
}
