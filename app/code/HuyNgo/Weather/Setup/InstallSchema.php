<?php
declare(strict_types=1);

namespace HuyNgo\Weather\Setup;

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
            ->newTable($setup->getTable('HuyNgo_weather'))
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
                'place',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'description',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'icon',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'temperature',
                Table::TYPE_FLOAT,
                null,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'temperature_min',
                Table::TYPE_FLOAT,
                null,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'temperature_max',
                Table::TYPE_FLOAT,
                null,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'feels_like',
                Table::TYPE_FLOAT,
                null,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'pressure',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'humidity',
                Table::TYPE_DECIMAL,
                null,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'speed_wind',
                Table::TYPE_DECIMAL,
                null,
                [
                    'nullable' => true,
                ]
            )
            ->addColumn(
                'city',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ]
            )
            ->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ]
            )
        ;


        $setup->getConnection()->createTable($table);
    }
}
