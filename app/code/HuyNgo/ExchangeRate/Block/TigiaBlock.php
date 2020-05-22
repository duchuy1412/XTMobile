<?php
    namespace HuyNgo\ExchangeRate\Block;
    use Magento\Framework\View\Element\Template;

class TigiaBlock extends Template
{
    private $_tigiaFactory;

    public function __construct(
        Template\Context $context,
        \HuyNgo\ExchangeRate\Model\TigiaFactory $tigiaFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_tigiaFactory = $tigiaFactory;
    }

    public function getTigiaInformation()
    {
        return $this->_tigiaFactory->create()->getExchangerateResponse();
    }
}