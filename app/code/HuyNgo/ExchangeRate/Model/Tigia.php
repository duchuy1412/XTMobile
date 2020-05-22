<?php

namespace HuyNgo\ExchangeRate\Model;


use Magento\Framework\App\Request\Http;

class Tigia
{
    const REQUEST_TIMEOUT = 2000;

    const END_POINT_URL = 'http://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=1';

    private $response;
    /**
     * @var \Magento\Framework\HTTP\Client\CurlFactory
     */
    private $curlFactory;
    /**
     * @var Http
     */
    private $http;
    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    private $jsonHelper;

    /**
     * Weather constructor.
     * @param \Magento\Framework\HTTP\Client\CurlFactory $curlFactory
     * @param Http $http
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\HTTP\Client\CurlFactory $curlFactory,
        Http $http,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    )
    {
        $this->curlFactory = $curlFactory;
        $this->http = $http;
        $this->jsonHelper = $jsonHelper;
    }

    public function getExchangerateResponse()
    {
        if(!$this->response){
            $this->response = (object) $this->getResponseFromEndPoint();
        }
        return $this->response;
    }

    private function getResponseFromEndPoint()
    {
        return $this->jsonHelper->jsonDecode($this->getResponse());
        // return $this->getResponse();
    }

    private function getResponse()
    {
        /** @var \Magento\Framework\HTTP\Client\Curl $client */
        // $client = $this->curlFactory->create();
        // $client->setTimeout(self::REQUEST_TIMEOUT);
        // $client->get(
        //     self::END_POINT_URL
        // );
        // $json = ($client->getBody());
        // return $json;
        $sXML = $this->download_page(self::END_POINT_URL);
        $xml = simplexml_load_string($sXML);
        $json = json_encode($xml);
        return $json;
    }

    private function download_page($path){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$path);
        curl_setopt($ch, CURLOPT_FAILONERROR,1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 150);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $retValue = curl_exec($ch);          
        curl_close($ch);
        return $retValue;
    }
}
