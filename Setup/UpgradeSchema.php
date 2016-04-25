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
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    [
                        'nullable' => false,
                        'default'  => 0
                    ],
                    'Stop Further Rule Processing'
                )
                ->addColumn(
                    'method_php',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
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
                    1,
                    [
                        'nullable' => false,
                        'default'  => 1
                    ],
                    'Status'
                )
                ->setComment(
                    'Stickers Table'
                );
            $setup->getConnection()->createTable($table);
        }

        if (version_compare($context->getVersion(), '0.0.4') < 0) {
            $table = $setup->getConnection()
                ->newTable($setup->getTable('luxinten_productstickers_images'))
                ->addColumn(
                    'image_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary'  => true
                    ],
                    'Image ID'
                )->addColumn(
                    'sticker_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Sticker ID'
                )
                ->addColumn(
                    'image_type',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    20,
                    [
                        'nullable' => false
                    ],
                    'Image Type'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Store ID'
                )
                ->addColumn(
                    'path',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    150,
                    [],
                    'Path'
                )
                ->addIndex(
                    $setup->getIdxName(
                        'luxinten_productstickers/images',
                        ['sticker_id']
                    ),
                    ['sticker_id']
                )
                ->setComment(
                    'Sticker Images Table'
                );
            $setup->getConnection()->createTable($table);
        }

        if (version_compare($context->getVersion(), '0.0.5') < 0) {
            $table = $setup->getConnection()
                ->newTable($setup->getTable('luxinten_productstickers_rules'))
                ->addColumn(
                    'rule_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary'  => true
                    ],
                    'Rule ID'
                )->addColumn(
                    'sticker_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Sticker ID'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Store ID'
                )
                ->addColumn(
                    'conditions_serialized',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false
                    ],
                    'Conditions serialized'
                )
                ->addIndex(
                    $setup->getIdxName(
                        'luxinten_productstickers/rules',
                        array('sticker_id')),
                    ['sticker_id'])
                ->setComment(
                    'Sticker Rules Table'
                );
            $setup->getConnection()->createTable($table);
        }

        if (version_compare($context->getVersion(), '0.0.6') < 0) {
            $table = $setup->getConnection()
                ->newTable($setup->getTable('luxinten_productstickers_text'))
                ->addColumn(
                    'text_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary'  => true
                    ],
                    'Text ID'
                )->addColumn(
                    'sticker_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Sticker ID'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Store ID'
                )
                ->addColumn(
                    'text',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false
                    ],
                    'Text'
                )
                ->addIndex(
                    $setup->getIdxName(
                        'luxinten_productstickers/text', array('sticker_id')),
                    ['sticker_id'])
                ->addIndex(
                    $setup->getIdxName(
                        'luxinten_productstickers/text', array('sticker_id', 'store_id'),
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                    ['sticker_id', 'store_id'],
                    [
                        'type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ])
                ->setComment(
                    'Sticker Text Table'
                );
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }


}