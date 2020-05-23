<?php
declare(strict_types=1);

namespace HuyNgo\TiGia\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use HuyNgo\TiGia\Model\TiGiaFactory;
use Zend\Json\Decoder;
use Zend\Json\Json;

class TigiaBlock extends Template implements BlockInterface
{
    protected $_template = "widget/tigia.phtml";
    private $factory;

    public function __construct(
        Template\Context $context,
        TiGiaFactory $factory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->factory = $factory;
    }

    public function getTiGia()
    {
        $factory = $this->factory->create();
        $tigia = $factory
            ->getCollection()
            ->addOrder('created_at', 'ASC')
            ->getLastItem();

        if ($tigia->isEmpty()) {
            return null;
        }

        return $tigia;
    }
}
