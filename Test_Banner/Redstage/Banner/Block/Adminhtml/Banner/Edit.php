<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */
namespace Redstage\Banner\Block\Adminhtml\Banner;

/**
 * Class Edit
 * @package Redstage\Banner\Block\Adminhtml\Banner
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_registry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize banner edit page. Set management buttons
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_banner';
        $this->_blockGroup = 'Redstage_Banner';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Banner'));
        $this->buttonList->update('delete', 'label', __('Delete Banner'));

        $this->buttonList->add(
            'save_and_edit_button',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ]
            ],
            100
        );
    }

    /**
     * Get current loaded banner ID
     *
     * @return mixed
     */
    public function getBannerId()
    {
        return $this->_registry->registry('current_rsbanner')->getId();
    }

    /**
     * Get header text for banner edit page
     *
     * @return \Magento\Framework\Phrase|string
     */
    public function getHeaderText()
    {
        if ($this->_registry->registry('current_rsbanner')->getId()) {
            return $this->escapeHtml($this->_registry->registry('current_rsbanner')->getName());
        } else {
            return __('New Banner');
        }
    }

    /**
     * Get form action URL
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('adminhtml/*/save');
    }
}
