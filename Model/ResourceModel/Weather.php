<?php

namespace Kostynenko\Weather\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Weather resource
 */
class Weather extends AbstractDb
{
    /**
     * Initialize resource
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }
    protected function _construct()
    {
        $this->_init('dk_weather', 'weather_id');
    }


}
