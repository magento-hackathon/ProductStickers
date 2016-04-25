<?php

namespace  Luxinten\ProductStickers\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
    
        if (version_compare($context->getVersion(), '0.0.3') < 0) {
            $table = $setup->getConnection()
                ->newTable($setup->getTable('luxinten_productstickers'))
                ->addColumn(
                    'sticker_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary'  => true
                    ],
                    'Sticker ID'
                )->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    5,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Store ID'
                )
                ->addColumn(
                    'sticker_title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    150,
                    [],
                    'Sticker Title'
                )
                ->addColumn(
                    'position',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    3,
                    [],
                    'Position'
                )
                ->addColumn(
                    'priority',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    [
                        'nullable' => false,
                        'default'  => 0
                    ],
                    'Priority'
                )
                ->addColumn(
                    'sticker_type',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                        'default'  => 'image'
                    ],
                    'Sticker Type'
                )
                ->addColumn(
                    'stop_rule_processing',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                        'default'  => 0
                    ],
                    'Stop Further Rule Processing'
                )
                ->addColumn(
                    'method_php',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                        'default'  => 0,
                        'unsigned' => true
                    ],
                    'Use PHP Block Processing'
                )
                ->addColumn(
                    'enabled',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    255,
                    [
                        'nullable' => false,
                        'default'  => 1
                    ],
                    'Status'
                )
                ->setComment(
                    'Custom Table'
                );
            $setup->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }
}