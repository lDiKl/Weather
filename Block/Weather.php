<?php
namespace Kostynenko\Weather\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Weather extends Template implements BlockInterface {

    private $_weather;

    public function __construct(
        Template\Context $context,
        \Kostynenko\Weather\Model\Weather $weather
    ) {
        $this->_weather = $weather;
        parent::__construct($context);
    }
    public function getWeatherInformation() {
        return $this->_weather->getWeatherResponse();
    }
}
