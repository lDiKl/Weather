<?php
namespace Kostynenko\Weather\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    protected $_weatherFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Kostynenko\Weather\Model\WeatherFactory $weatherFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_weatherFactory = $weatherFactory;
        return parent::__construct($context);
    }

    public function execute(){}
}
