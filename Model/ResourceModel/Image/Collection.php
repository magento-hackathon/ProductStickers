<?php

namespace Luxinten\ProductStickers\Model\ResourceModel\Image;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Luxinten\ProductStickers\Model\Image', 'Luxinten\ProductStickers\Model\ResourceModel\Image');
    }
}