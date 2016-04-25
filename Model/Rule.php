<?php

namespace Luxinten\ProductStickers\Model;

use Magento\Rule\Model\AbstractModel;
use Magento\Rule\Model\Action\Collection;
use Magento\Framework\App\ObjectManager as ObjectManager;

class Rule extends AbstractModel
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Luxinten\ProductStickers\Model\ResourceModel\Rule');
    }
    
    public function getConditionsInstance()
    {
        return ObjectManager::getInstance()->create('Luxinten\ProductStickers\Model\Rule\Condition\Combine');
    }

    /**
     * Getter for rule actions collection instance
     *
     * @return Collection
     */
    public function getActionsInstance()
    {
        return ObjectManager::getInstance()->create('Magento\Rule\Model\Action\Collection');
    }
}