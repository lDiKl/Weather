<?php
namespace Kostynenko\Weather\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Weather extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const REQUEST_TIMEOUT = 200;
    const END_POINT_URL = 'api.openweathermap.org/data/2.5/weather?q=';
    const UNITS = 'metric'; // imperial(Fahrenheit), metric(Celsius), default(Kelvin)
    const CACHE_TAG = 'dk_weather';
    private $json;
    private $curlFactory;
    protected $_cacheTag = 'dk_weather';
    protected $_eventPrefix = 'dk_weather';
    protected $scopeConfig;
    protected $_encryptor;
    protected $_weatherFactory;
//e0050f339f66b97db6ac60fe7a3fc5a7

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        \Magento\Framework\HTTP\Client\CurlFactory $curlFactory,
        ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor,
        array $data = []
    ){
        $this->curlFactory = $curlFactory;
        $this->json = $json;
        $this->scopeConfig = $scopeConfig;
        $this->_encryptor = $encryptor;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function _construct() {
        $this->_init('Kostynenko\Weather\Model\ResourceModel\Weather');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        return $values = [];
    }

    public function getWeatherResponse() {
        $responce = $this->json->unserialize($this->getResponse());

        // Weather Icon
        $weather['main']        = $responce['weather'][0]['main'];
        $weather['description'] = $responce['weather'][0]['description'];
        $weather['icon']        = 'http://openweathermap.org/img/wn/'.$responce['weather'][0]['icon'].'@2x.png';
        $weather['temp']        = $responce['main']['temp'];
        $weather['name']        = $responce['name'];

        return $weather;
    }

    private function getResponse() {
        //TODO: Need to change the logic, instead of getting data directly from the API, need to take data from the database.
        /** @var \Magento\Framework\HTTP\Client\Curl $client */
        $client = $this->curlFactory->create();
        $client->setTimeout(self::REQUEST_TIMEOUT);
        $client->get(
            self::END_POINT_URL . $this->scopeConfig->getValue('dk_weather/config/city') .
            '&units='.self::UNITS.
            '&appid=' . $this->_encryptor->decrypt($this->scopeConfig->getValue('dk_weather/config/apikey'))
        );
        return $client->getBody();
    }

    public function update() {
    //TODO: Save data from API to DB
    }
}
