<?php
declare(strict_types=1);

namespace HuyNgo\TinTuc\Model\ResourceModel\TinTuc;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'HuyNgo_tintuc_tintuc_collection';
    protected $_eventObject = 'tintuc_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('HuyNgo\TinTuc\Model\TinTuc', 'HuyNgo\TinTuc\Model\ResourceModel\TinTuc');
    }

}