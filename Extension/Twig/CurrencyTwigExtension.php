<?php

namespace Vespolina\MonetaryBundle\Extension\Twig;

use Vespolina\MonetaryBundle\Model\Monetary;
use Vespolina\MonetaryBundle\Model\Currency;

class CurrencyTwigExtension extends \Twig_Extension
{
    protected $monetaryManager;

    public function __construct($monetaryManager)
    {
        $this->monetaryManager = $monetaryManager;
    }
    // the magic function that makes this easy
    public function getFilters()
    {
        return array(
            'currencyConvert'  => new \Twig_Filter_Method($this, 'currencyConvert'),
        );
    }

    // your custom function
    public function currencyConvert($price, $currency)
    {
        $this->secondCurrency = $this->getCurrency('The codes assigned for transactions where no name is involve', 'XXX', 'X');
        $baseCurrency = new CurrencySOL();
        $monetary = new Monetary($price, $baseCurrency);
        $monetaryConverted = $this->monetaryManager->exchange($monetary, $currency);
        return $monetaryConverted->getValue();
    }

    // for a service we need a name
    public function getName()
    {
        return 'currency_twig_extension';
    }
}