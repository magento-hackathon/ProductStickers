<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Luxinten\ProductStickers\Controller\Adminhtml\Stickers;
use Magento\Framework\Controller\ResultFactory;
class Index extends Stickers
{
    public function execute()
    {
        die('F');
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('QTV'));
        return $resultPage;
    }
}