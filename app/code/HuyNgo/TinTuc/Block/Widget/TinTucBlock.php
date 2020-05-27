<?php
declare(strict_types=1);

namespace HuyNgo\TinTuc\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use HuyNgo\TinTuc\Model\TinTucFactory;
use Zend\Json\Decoder;
use Zend\Json\Json;

class TinTucBlock extends Template implements BlockInterface
{
    protected $_template = "widget/tintuc.phtml";
    private $factory;

    public function __construct(
        Template\Context $context,
        TinTucFactory $factory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->factory = $factory;
    }

    public function getTinTuc()
    {
        $factory = $this->factory->create();
        $tintuc = $factory
            ->getCollection()
            ->addOrder('created_at', 'ASC')
            ->getLastItem();

        if ($tintuc->isEmpty()) {
            return null;
        }

        return $tintuc;
    }
}
