<?php
declare(strict_types=1);

namespace HuyNgo\Weather\Model\ResourceModel\Weather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'HuyNgo_weather_weather_collection';
    protected $_eventObject = 'weather_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('HuyNgo\Weather\Model\Weather', 'HuyNgo\Weather\Model\ResourceModel\Weather');
    }

}