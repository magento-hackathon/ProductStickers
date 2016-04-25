<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Luxinten\ProductStickers\Controller\Adminhtml\ProductStickers;
use Magento\Framework\Controller\ResultFactory;
class Index extends \Luxinten\ProductStickers\Controller\Adminhtml\ProductsStickers
{
    public function executeInternal()
    {
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('QTV'));
        return $resultPage;
    }
}