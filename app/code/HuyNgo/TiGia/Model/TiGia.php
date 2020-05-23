<?php
declare(strict_types=1);

namespace HuyNgo\TiGia\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class TiGia extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'HuyNgo_tigia_tigia';

    protected $_cacheTag = 'HuyNgo_tigia_tigia';

    protected $_eventPrefix = 'HuyNgo_tigia_tigia';

    protected function _construct()
    {
        $this->_init('HuyNgo\TiGia\Model\ResourceModel\TiGia');
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