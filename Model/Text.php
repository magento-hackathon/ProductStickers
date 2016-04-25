<?php

namespace Luxinten\ProductStickers\Model;

use \Magento\Framework\Model\AbstractModel;

class Text extends AbstractModel
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Luxinten\ProductStickers\Model\ResourceModel\Text');
    }
}