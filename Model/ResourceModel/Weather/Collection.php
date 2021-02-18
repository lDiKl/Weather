<?php

namespace Kostynenko\Weather\Model\ResourceModel\Weather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {

    protected $_idFieldName = 'weather_id';
    protected $_eventPrefix = 'dk_weather_collection';
    protected $_eventObject = 'weather_collection';

    /**
     * Define resource model
     *
     * @return void
     */

    public function _construct() {
        $this->_init(\Kostynenko\Weather\Model\Weather::class, \Kostynenko\Weather\Model\ResourceModel\Weather::class);
    }
}
