<?php

namespace Luxinten\ProductStickers\Model\ResourceModel\Rule;

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
        $this->_init('Luxinten\ProductStickers\Model\Rule', 'Luxinten\ProductStickers\Model\ResourceModel\Rule');
    }

    public function applyRulesToProductsCollection($products)
    {
        foreach ($products as $product) {
            $this->applyRulesToProduct($product);
        }
    }

    public function applyRulesToProduct($product)
    {
        $rules = $this;
        $stickersIds = array();

        foreach ($rules as $rule) {
            if ($rule->validate($product)) {
                $stickersIds[] = $rule->getStickerId();
                if ($rule->getStopRuleProcessing()) {
                    break;
                }
            }
        }
        if (count($stickersIds)) {
            $product->setProductStickers($stickersIds);
        }
    }

    protected function _afterLoad()
    {
        $this->walk('afterLoad');
    }
}