<?php
namespace Luxinten\ProductStickers\Controller\Adminhtml;
abstract class Stickers extends \Magento\Backend\App\Action
{
    protected $_coreRegistry;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Translate\InlineInterface $translateInline,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_coreRegistry = $coreRegistry;
        $this->_fileFactory = $fileFactory;
        $this->_translateInline = $translateInline;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
        $this->resultRawFactory = $resultRawFactory;

        die('Hackathon');
    }
    /**
     * @return $this
     */
    protected function _initAction()
    {
        die('Hackathon');
        $resultPage = $this->resultPageFactory->create();

        return $resultPage;
    }

    /**
     * Retrieve well-formed admin user data from the form input
     *
     * @param array $data
     * @return array
     */

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        die('Hackathon');
        return $this->_authorization->isAllowed('Luxinten_ProductStickers::product_stickers');
    }

}