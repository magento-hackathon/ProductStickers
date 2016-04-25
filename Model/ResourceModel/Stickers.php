<?php

namespace Luxinten\ProductStickers\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject;
use Magento\Framework\DB;

class Stickers extends AbstractDb
{

    protected $_storeValueAttributes = array('text');

    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('luxinten_productstickers_sticker', 'sticker_id');
        $this->_setResource(null, array(
            'stickers_text' => 'luxinten_productstickers/text'
        ));
    }

    protected function _joinTextTable(DB\Select $select, $storeId = 0, $suffix = '')
    {
        $connection = $this->getConnection();
        $tableAlias = 'text_table' . $suffix;
        $fieldAlias = 'text' . $suffix;
        $fields = array(
            $fieldAlias => $tableAlias . '.text',
        );

        if (empty($suffix)) {
            $fields['store_id'] = $tableAlias . '.store_id';
        }

        $select->joinLeft(
            array($tableAlias => $this->getTable('stickers_text')),
            '(' . implode (') AND (', array(
                sprintf('%s = %s',
                    $connection->quoteIdentifier($this->getMainTable() . '.sticker_id'),
                    $connection->quoteIdentifier($tableAlias . '.sticker_id')),
                sprintf('%s = %d',
                    $connection->quoteIdentifier($tableAlias . '.store_id'),
                    $storeId),
            )) . ')',
            $fields
        );
        return $this;
    }

    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        $suffix = '';
        if (($storeId = $object->getStoreId()) !== 0 && isset($storeId)) {
            $this->_joinTextTable($select, $storeId);
            $suffix = '_default';
        }

        $this->_joinTextTable($select, 0, $suffix);
        return $select;
    }

    public function processObject(AbstractModel $object)
    {
        if ($object->getStoreId() !== 0 && $object->getStoreId() !== null) {
            foreach ($this->_storeValueAttributes as $attributeCode) {
                if ($object->hasData($attributeCode . '_default')) {
                    $object->setAttributeDefaultValue(
                        $attributeCode,
                        $object->getData($attributeCode . '_default'));
                    if (!$object->hasData($attributeCode)) {
                        $object->setData(
                            $attributeCode,
                            $object->getData($attributeCode . '_default'));
                    } else {
                        $object->setExistsStoreValueFlag($attributeCode);
                    }
                    $object->unsetData($attributeCode . '_default');
                }
            }
        } else {
            foreach ($this->_storeValueAttributes as $attributeCode) {
                if ($object->hasData($attributeCode)) {
                    $object->setAttributeDefaultValue(
                        $attributeCode,
                        $object->getData($attributeCode ));
                }
            }
        }

        return $this;
    }

    protected function _afterLoad(AbstractModel $object)
    {
        parent::_afterLoad($object);

        $this->processObject($object);

        return $this;
    }

    protected function _afterSave(AbstractModel $object)
    {
        parent::_afterSave($object);

        $storeId = $object->getStoreId();
        $connection = $this->getConnection();
        if (!isset($storeId)) {
            $storeId = 0;
        }
        if ($storeId == 0 || ($object->hasData('text') && $object->getData('text') !== null)) {
            $data = new DataObject($object->getData());
            $data->setStoreId($storeId);
            $bind = $this->_prepareDataForTable($data, $this->getTable('stickers_text'));
            if (isset($bind['text_id'])) {
                unset($bind['text_id']);
            }
            $connection->insertOnDuplicate(
                $this->getTable('stickers_text'), $bind, $this->_storeValueAttributes);
        } elseif ($object->hasData('text') && $object->getData('text') === null) {
            $connection->delete($this->getTable('stickers_text'),
                '(' . implode(') AND (', array(
                    $connection->quoteInto('store_id = ?', $storeId),
                    $connection->quoteInto('sticker_id = ?', $object->getId()),
                )) . ')');
        }

        return $this;
    }

}