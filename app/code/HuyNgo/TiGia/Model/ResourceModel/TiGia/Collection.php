<?php
declare(strict_types=1);

namespace HuyNgo\TiGia\Model\ResourceModel\TiGia;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'HuyNgo_tigia_tigia_collection';
    protected $_eventObject = 'tigia_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('HuyNgo\TiGia\Model\TiGia', 'HuyNgo\TiGia\Model\ResourceModel\TiGia');
    }

}