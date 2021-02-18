<?php
namespace Kostynenko\Weather\Cron;

class Weather {
    protected $_weather;

    public function __construct(
        \Kostynenko\Weather\Model\Weather $weather
    ){
        $this->_weather = $weather;
    }

    public function update() {
        $this->_weather->update();
    }
}
