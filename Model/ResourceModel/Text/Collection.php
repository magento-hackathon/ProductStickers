<?php

namespace Luxinten\ProductStickers\Model\ResourceModel\Text;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Text extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Luxinten\ProductStickers\Model\Text', 'Luxinten\ProductStickers\Model\ResourceModel\Text');
    }
}