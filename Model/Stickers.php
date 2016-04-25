<?php

namespace Luxinten\ProductStickers\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Catalog\Model\AbstractModel as CatalogModelAbstract;
use Magento\Framework\App\ObjectManager as ObjectManager;

class Stickers extends AbstractModel
{

    /**
     * Attribute default values
     *
     * This array contain default values for attributes which was redefine
     * value for store
     *
     * @var array
     */
    protected $_defaultValues = array();

    /**
     * This array contains codes of attributes which have value in current store
     *
     * @var array
     */
    protected $_storeValuesFlags = array();

    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Luxinten\ProductStickers\Model\ResourceModel\Stickers');
    }

    public function setAttributeDefaultValue($attributeCode, $value)
    {
        $this->_defaultValues[$attributeCode] = $value;
        return $this;
    }

    /**
     * Retrieve default value for attribute code
     *
     * @param   string $attributeCode
     * @return  array|boolean
     */
    public function getAttributeDefaultValue($attributeCode)
    {
        return array_key_exists($attributeCode, $this->_defaultValues) ? $this->_defaultValues[$attributeCode] : false;
    }

    /**
     * Set attribute code flag if attribute has value in current store and does not use
     * value of default store as value
     *
     * @param   string $attributeCode
     * @return  CatalogModelAbstract
     */
    public function setExistsStoreValueFlag($attributeCode)
    {
        $this->_storeValuesFlags[$attributeCode] = true;
        return $this;
    }

    /**
     * Check if object attribute has value in current store
     *
     * @param   string $attributeCode
     * @return  bool
     */
    public function getExistsStoreValueFlag($attributeCode)
    {
        return array_key_exists($attributeCode, $this->_storeValuesFlags);
    }

    protected function _afterLoad()
    {
        $data = $this->getData();
        $objectManager = ObjectManager::getInstance();
        $images = $objectManager->create('Luxinten\ProductStickers\Model\Image')
                  ->getCollection()
                  ->addFieldToFilter('sticker_id', $this->getId());
        foreach ($images as $image) {
            $data['images'][$image->getImageType()] = array('image_id' => $image->getId(),
                                                            'path'     => $image->getPath()
            );
        }

        return $this;
    }

    protected function _afterSave()
    {
        $images = $this->getImages();
        if ($images) {
            $objectManager = ObjectManager::getInstance();
            $image = $objectManager->create('Luxinten\ProductStickers\Model\Image');
            foreach ($images as $type => $path) {
                $entry = $image->getCollection()
                             ->addFieldToFilter('sticker_id', $this->getStickerId())
                             ->addFieldToFilter('image_type', $type)
                             ->getFirstItem();
                if ($entry->getData()) {
                    if ($path) {
                        $entry->setData('path',$path)->save();
                    } else {
                        $entry->delete();
                    }
                } else {
                    $imageData = array('image_type' => $type,
                                       'path'       => $path,
                                       'sticker_id' => $this->getStickerId(),
                    );
                    $image->setData($imageData)->save();
                }
            }
        }
        return $this;
    }

}