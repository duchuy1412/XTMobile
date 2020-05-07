<?php

namespace HuyNgo\WeatherModule\Block;


use Magento\Framework\View\Element\Template;

class WeatherBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \HuyNgo\WeatherModule\Model\WeatherFactory
     */
    private $weatherFactory;

    /**
     * WeatherBlock constructor.
     * @param Template\Context $context
     * @param \HuyNgo\WeatherModule\Model\WeatherFactory $weatherFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \HuyNgo\WeatherModule\Model\WeatherFactory $weatherFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->weatherFactory = $weatherFactory;
    }

    /**
     * @return \HuyNgo\WeatherModule\Model\Weather[]
     */
    public function getWeatherInformation()
    {
        return $this->weatherFactory->create()->getWeatherResponse();
    }
}