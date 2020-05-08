<?php
    namespace HuyNgo\TiGia\Block;

    use Magento\Framework\View\Element\Template;

class TigiaBlock extends \Magento\Framework\View\Element\Template
{
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