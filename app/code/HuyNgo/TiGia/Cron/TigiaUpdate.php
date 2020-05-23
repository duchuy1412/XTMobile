<?php
declare(strict_types=1);

namespace HuyNgo\TiGia\Cron;

use Magento\Framework\Exception\CronException;
use Magento\Framework\ObjectManagerInterface;
use HuyNgo\TiGia\Model\TiGia;
use HuyNgo\TiGia\Model\ResourceModel;
use Zend\Json\Decoder;
use Zend\Json\Json;
use Psr\Log\LoggerInterface;

class TigiaUpdate
{
    private $objectManager;
    private $resource;

    const END_POINT_URL = 'http://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=1';
    
    public function __construct(
        ObjectManagerInterface $objectManager,
        ResourceModel\TiGia $resource
    )
    {
        $this->objectManager = $objectManager;
        $this->resource = $resource;
    }

    public function execute()
    {
        $tigia = $this->getTiGiaRespone();

        if (null === $tigia) {
            return $this;
        }

        try {
            $this->resource->save($tigia);
        } catch (\Exception $e) {
            $this->objectManager->get(LoggerInterface::class)->error($e->getMessage());
        }

        return $this;
    }

    private function getTiGiaRespone(): ?TiGia
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
            
            $xml = simplexml_load_string($retValue);
            $json = json_encode($xml);
        } catch (\Exception $e) {
            $this->objectManager->get(LoggerInterface::class)->error($e->getMessage());

            return null;
        }

        $tigia = $this->objectManager->create(TiGia::class);

        $tigia->setData(
            [
                'vcb' => $json,
            ]
        );

        return $tigia;
    }
}