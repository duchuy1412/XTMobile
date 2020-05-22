<?php
declare(strict_types=1);

namespace HuyNgo\Weather\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Weather extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'HuyNgo_weather_weather';

    protected $_cacheTag = 'HuyNgo_weather_weather';

    protected $_eventPrefix = 'HuyNgo_weather_weather';

    protected function _construct()
    {
        $this->_init('HuyNgo\Weather\Model\ResourceModel\Weather');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}