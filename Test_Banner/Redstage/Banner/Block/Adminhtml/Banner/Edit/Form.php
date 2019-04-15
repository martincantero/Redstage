<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */
namespace Redstage\Banner\Block\Adminhtml\Banner\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;

/**
 * Class Form
 * @package Redstage\Banner\Block\Adminhtml\Banner\Edit
 */
class Form extends Generic
{

    /**
     * Form constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Template $template
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $formFactory, $data);
    }


    /**
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id'      => 'edit_form',
                    'action'  => $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]),
                    'method'  => 'post',
                    'enctype' => 'multipart/form-data'
                ]
            ]
        );

        $banner = $this->_coreRegistry->registry('current_rsbanner');

        if ($banner->getId()) {
            $form->addField('banner_id', 'hidden', ['name' => 'banner_id']);
            $form->setValues($banner->getData());
        }

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
