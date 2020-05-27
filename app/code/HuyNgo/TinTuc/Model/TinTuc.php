<?php
declare(strict_types=1);

namespace HuyNgo\TinTuc\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class TinTuc extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'HuyNgo_tintuc_tintuc';

    protected $_cacheTag = 'HuyNgo_tintuc_tintuc';

    protected $_eventPrefix = 'HuyNgo_tintuc_tintuc';

    protected function _construct()
    {
        $this->_init('HuyNgo\TinTuc\Model\ResourceModel\TinTuc');
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