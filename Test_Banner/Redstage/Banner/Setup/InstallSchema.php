<?php


namespace Redstage\Banner\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Message\ManagerInterface as MessageManager;


/**
 * Class InstallSchema
 * @package Redstage\Banner\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * InstallSchema constructor.
     * @param MessageManager $messageManager
     */
    public function __construct(
        MessageManager $messageManager
    )
    {
        $this->messageManager   = $messageManager;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('redstage_banner')) {
            try {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('redstage_banner')
                )->addColumn('banner_id', Table::TYPE_INTEGER, null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true
                        ], 'Banner ID')
                    ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable => false'], 'Banner Name')
                    ->addColumn('status', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '1'], 'Banner Status')
                    ->addColumn('type', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '0'], 'Banner Type')
                    ->addColumn('content', Table::TYPE_TEXT, '64k', [], 'Custom html, css')
                    ->addColumn('image', Table::TYPE_TEXT, 255, [], 'Banner Image')
                    ->addColumn('url_banner', Table::TYPE_TEXT, 255, [], 'Banner Url')
                    ->addColumn('title', Table::TYPE_TEXT, 255, [], 'Title')
                    ->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [], 'Banner Created At')
                    ->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [], 'Banner Updated At')
                    ->setComment('Banner Table');

                $installer->getConnection()->createTable($table);

                $installer->getConnection()->addIndex(
                    $installer->getTable('redstage_banner'),
                    $setup->getIdxName(
                        $installer->getTable('redstage_banner'),
                        ['name', 'image', 'url_banner'],
                        AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['name', 'image', 'url_banner'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                );

                $installer->endSetup();

            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage('There was a problem in Redstage_Banner Install Process: ' . $e->getMessage());
            }
        }

    }

}
