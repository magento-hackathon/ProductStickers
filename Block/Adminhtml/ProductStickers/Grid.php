<?php

namespace Luxinten\ProductStickers\Block\Adminhtml\ProductStickers;

class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Luxinten_ProductSticker';
        $this->_controller = 'adminhtml_stickers';
        $this->_headerText = __('Product Stickers');
        $this->_addButtonLabel = __('Add New Sticker');
        parent::_construct();
        $this->buttonList->add(
            'sticker_apply',
            [
                'label' => __('Product Sticker'),
                'onclick' => "location.href='" . $this->getUrl('stickers/*/applyProductsticker') . "'",
                'class' => 'apply'
            ]
        );
    }
}