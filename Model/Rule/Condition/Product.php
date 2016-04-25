<?php

namespace Luxinten\ProductStickers\Model\Rule\Condition;

use Magento\CatalogRule\Model\Rule\Condition;
use Magento\Framework\DataObject;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\App\ObjectManager as ObjectManager;

class Product extends Condition\Product
{

    /**
     * @var \Luxinten\ProductStickers\Helper\Data;
     */
    protected $_helper;
    protected $_date;

    public function _construct(DateTime $date)
    {
        $this->_helper = ObjectManager::getInstance()->get('Luxinten\ProductStickers\Helper\Data');
        $this->_date = $date;
    }

    protected function _addSpecialAttributes(array &$attributes)
    {
        $attributes['product_state_condition'] = __('Product state');
        parent::_addSpecialAttributes($attributes);
    }

    /**
     * Retrieve select option values
     *
     * @return array
     */
    public function getValueSelectOptions()
    {
        $this->_prepareValueOptions();
        return $this->getData('value_select_options');
    }

    protected function _prepareValueOptions()
    {
        if ($this->getAttribute() === 'product_state_condition'){
            $selectOptions = array(
                'new'      => __('New'),
                'special'  => __('Special'),
            );
            $this->setData('value_select_options', $selectOptions);
        }

        parent::_prepareValueOptions();
    }

    public function getInputType()
    {
        if ($this->getAttribute()==='product_state_condition') {
            return 'select';
        }

        return parent::getInputType();
    }

    public function getValueElementType()
    {
        if ($this->getAttribute()==='product_state_condition') {
            return 'select';
        }

        return parent::getValueElementType();
    }

    public function validate(DataObject $object)
    {
        $attrCode = $this->getAttribute();

        if ($attrCode == 'product_state_condition') {
            $value = $this->getValue();
            $today = strtotime($this->date);
            $fromDate = 0;
            $toDate = 0;

            if ($value == 'new') {
                $fromDate = strtotime($object->getData('news_from_date'));
                $toDate = strtotime($object->getData('news_to_date'));
            } else if ($value == 'special'){
                $fromDate = strtotime($object->getData('special_from_date'));
                $toDate = strtotime($object->getData('special_to_date'));
            }

            if (($today < $toDate && $today > $fromDate)
                || ($fromDate && !$toDate && $today > $fromDate)
                || (!$fromDate && $today < $toDate)
            ) {
                return $this->validateAttribute($value);
            } else {
                return !$this->validateAttribute($value);;
            }
        }

        return parent::validate($object);
    }
}