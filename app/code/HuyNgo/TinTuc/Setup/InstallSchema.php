<?php
namespace HuyNgo\TinTuc\Setup;
 
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
 
 
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('HuyNgo_tintuc');
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
                     'news',
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
                )->setOption('charset', 'utf8');
            $setup->getConnection()->createTable($table);
         }
        $setup->endSetup();
    }
}