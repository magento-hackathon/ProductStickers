<?php

namespace Luxinten\ProductStickers\Model\Rule\Condition;

use Magento\Rule\Model\Condition;
use Magento\Framework\App\ObjectManager as ObjectManager;

class Combine extends Condition\Combine
{

    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->setType('luxinten_productstickers/rule_condition_combine');
    }

    public function getNewChildSelectOptions()
    {
        $productCondition = ObjectManager::getInstance()->create('Luxinten\ProductStickers\Model\Rule\Condition\Product');
        $productAttributes = $productCondition->loadAttributeOptions()->getAttributeOption();
        $attributes = array();
        foreach ($productAttributes as $code => $label) {
            $attributes[] =
                array('value' => 'luxinten_productstickers/rule_condition_product|' . $code, 'label' => $label);
        }
        $conditions = parent::getNewChildSelectOptions();
        $conditions = array_merge_recursive(
            $conditions,
            array(
                array(
                    'value' => 'luxinten_productstickers/rule_condition_combine',
                    'label' => __('Conditions combination')
                ),
                array('label' => __('Product Attribute'), 'value' => $attributes),
            )
        );
        return $conditions;
    }
}