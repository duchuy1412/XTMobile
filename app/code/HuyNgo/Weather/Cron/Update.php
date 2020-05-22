<?php
declare(strict_types=1);

namespace HuyNgo\Weather\Cron;

use Magento\Framework\Exception\CronException;
use Magento\Framework\ObjectManagerInterface;
use HuyNgo\Weather\Model\Weather;
use HuyNgo\Weather\Model\ResourceModel;
use Zend\Json\Decoder;
use Zend\Json\Json;
use Psr\Log\LoggerInterface;

class Update
{
    private $objectManager;
    private $resource;

    public function __construct(
        ObjectManagerInterface $objectManager,
        ResourceModel\Weather $resource
    )
    {
        $this->objectManager = $objectManager;
        $this->resource = $resource;
    }

    public function execute()
    {
        $weather = $this->getWeatherByCity('Hanoi', 'VN');

        if (null === $weather) {
            return $this;
        }

        try {
            $this->resource->save($weather);
        } catch (\Exception $e) {
            $this->objectManager->get(LoggerInterface::class)->error($e->getMessage());
        }

        return $this;
    }

    private function getWeatherByCity(string $city, string $country): ?Weather
    {
        $uri = 'http://api.openweathermap.org/data/2.5/weather?q=Hanoi&lang=vi&units=metric&appid=29df95fdb8cbd9ed1b9edaaf5c0bb9f3';
        $client = new \Zend\Http\Client($uri, [
            'timeout' => 5
        ]);
        // $client->setParameterGet(
        //     [
        //         'appid' => '29df95fdb8cbd9ed1b9edaaf5c0bb9f3',
        //         'q' => \sprintf('%s,%s', $city, $country),
        //         'units' => 'metric',
        //         'lang' => 'vi',
        //     ]
        // );

        try {
            $response = $client->send();
            $data = Decoder::decode($response->getBody(), Json::TYPE_ARRAY);

            if (200 !== $response->getStatusCode()) {
                $this->objectManager->get(LoggerInterface::class)->error($data['message']);
                throw new CronException($data['message']);
            }
        } catch (\Exception $e) {
            $this->objectManager->get(LoggerInterface::class)->error($e->getMessage());

            return null;
        }

        /** @var Weather $weather */
        $weather = $this->objectManager->create(Weather::class);
        $tempWeather = $data['weather'][0];
        $weather->setData(
            [
                'city' => $city,
                'temperature' => $data['main']['temp'],
                'pressure' => $data['main']['pressure'],
                'humidity' => $data['main']['humidity'],
                'feels_like' => $data['main']['feels_like'],
                'temperature_max' => $data['main']['temp_max'],
                'temperature_min' => $data['main']['temp_min'],
                'icon' => $tempWeather['icon'],
                'description' => $tempWeather['description'],
                'place' => $data['name'],
                'speed_wind' => $data['wind']['speed'],
            ]
        );

        return $weather;
    }
}