<?php
namespace HuyNgo\TiGia\Setup;
 
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
 
 
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('HuyNgo_tigia');
        if (version_compare($context->getVersion(), '1.0.4', '<')) {
             if ($setup->getConnection()->isTableExists($tableName) != true){
                 $table = $setup->getConnection()->newTable($tableName)
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
        $setup->endSetup();
    }
}