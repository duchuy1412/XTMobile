<?php
declare(strict_types=1);

namespace HuyNgo\TinTuc\Cron;

use Magento\Framework\Exception\CronException;
use Magento\Framework\ObjectManagerInterface;
use HuyNgo\TinTuc\Model\TinTuc;
use HuyNgo\TinTuc\Model\ResourceModel;
use Zend\Json\Decoder;
use Zend\Json\Json;
use Psr\Log\LoggerInterface;

class TinTucUpdate
{
    private $objectManager;
    private $resource;

    const END_POINT_URL = 'http://vnexpress.net/rss/so-hoa.rss';
    
    public function __construct(
        ObjectManagerInterface $objectManager,
        ResourceModel\TinTuc $resource
    )
    {
        $this->objectManager = $objectManager;
        $this->resource = $resource;
    }

    public function execute()
    {
        $tintuc = $this->getTinTucRespone();

        if (null === $tintuc) {
            return $this;
        }

        try {
            $this->resource->save($tintuc);
        } catch (\Exception $e) {
            $this->objectManager->get(LoggerInterface::class)->error($e->getMessage());
        }

        return $this;
    }

    private function getTinTucRespone(): ?TinTuc
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,self::END_POINT_URL);
            curl_setopt($ch, CURLOPT_FAILONERROR,1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 150);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            $retValue = curl_exec($ch);          
            curl_close($ch);
            
            // $xml = simplexml_load_string($retValue);
            // $json = json_encode($xml);
        } catch (\Exception $e) {
            $this->objectManager->get(LoggerInterface::class)->error($e->getMessage());

            return null;
        }

        $tintuc = $this->objectManager->create(TinTuc::class);

        $tintuc->setData(
            [
                'news' => $retValue,
            ]
        );

        return $tintuc;
    }
}