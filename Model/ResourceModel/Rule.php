<?php

namespace Luxinten\ProductStickers\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Rule extends AbstractDb
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('luxinten_productstickers_rules', 'rule_id');
    }
}