<?php
namespace HuyNgo\TiGia\Cron;
use Psr\Log\LoggerInterface;

class TigiaUpdate {
    /**
     * @var \HuyNgo\TiGia\Model\TigiaFactory
     */
    protected $_tigiaFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct(
        \HuyNgo\TiGia\Model\TigiaFactory $tigiaFactory,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->_tigiaFactory = $tigiaFactory;
        $this->logger = $logger;
    }

    public function execute()
    {
        try {
           $this->_tigiaFactory->create()->getExchangerateResponse();
        } catch (\Exception $e) {
            // Save the log text if got the issue while get exchange rate response
            $this->logger->info($e);
        }
    }
}