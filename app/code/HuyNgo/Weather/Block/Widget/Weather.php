<?php
declare(strict_types=1);

namespace HuyNgo\Weather\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use HuyNgo\Weather\Model\WeatherFactory;

class Weather extends Template implements BlockInterface
{
    protected $_template = "weather.phtml";
    private $factory;

    public function __construct(
        Template\Context $context,
        WeatherFactory $factory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->factory = $factory;
    }

    public function getWeather()
    {
        $factory = $this->factory->create();
        $weather = $factory
            ->getCollection()
            ->addOrder('created_at', 'ASC')
            ->getLastItem();

        if ($weather->isEmpty()) {
            return null;
        }

        return $weather;
    }
}
