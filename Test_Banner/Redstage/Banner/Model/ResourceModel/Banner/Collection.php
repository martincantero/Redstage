<?php
/**
 * Redstage
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */

namespace Redstage\Banner\Model\ResourceModel\Banner;

/**
 * Class Collection
 * @package Redstage\Banner\Model\ResourceModel\Banner
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'banner_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'redstage_banner_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'banner_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Redstage\Banner\Model\Banner', 'Redstage\Banner\Model\ResourceModel\Banner');
    }

}
