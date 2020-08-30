<?php
declare(strict_types=1);
namespace HuyNgo\TiGia\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable('HuyNgo_tigia'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ]
            )
            ->addColumn(
                'vcb',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => '']
            )
            ->addColumn(
               'created_at',
               Table::TYPE_TIMESTAMP,
               null,
               [
                   'nullable' => false,
                   'default' => Table::TIMESTAMP_INIT
               ]
               );

        $setup->getConnection()->createTable($table);
    }
}
