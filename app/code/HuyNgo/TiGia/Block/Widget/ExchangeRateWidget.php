<?php
    namespace HuyNgo\TiGia\Block\Widget;
    use Magento\Framework\View\Element\Template;
    use Magento\Widget\Block\BlockInterface;

class ExchangeRateWidget extends Template implements BlockInterface
{
    protected $_template = "widget/tigia.phtml";

    private $_tigiaFactory;

    public function __construct(
        Template\Context $context,
        \HuyNgo\TiGia\Model\TigiaFactory $tigiaFactory,
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