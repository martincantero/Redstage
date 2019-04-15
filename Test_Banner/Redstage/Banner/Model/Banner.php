<?php
/**
 * Redstage
 *
 *
 * @category    Redstage
 * @package     Redstage_Banner
 */

namespace Redstage\Banner\Model;

/**
 * Class Banner
 * @package Redstage\Banner\Model
 */
class Banner extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * @var string
     */
    const CACHE_TAG = 'redstage_banner';

    /**
     * @var string
     */
    protected $_cacheTag = 'redstage_banner';

    /**
     * @var string
     */
    protected $_eventPrefix = 'redstage_banner';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Redstage\Banner\Model\ResourceModel\Banner');
    }

    /**
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}