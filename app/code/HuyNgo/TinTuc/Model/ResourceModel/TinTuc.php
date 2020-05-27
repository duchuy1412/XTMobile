<?php
declare(strict_types=1);

namespace HuyNgo\TinTuc\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class TinTuc extends AbstractDb
{

    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('HuyNgo_tintuc', 'id');
    }

}