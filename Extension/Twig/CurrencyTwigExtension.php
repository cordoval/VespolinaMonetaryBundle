<?php

namespace Vespolina\MonetaryBundle\Extension\Twig;

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
        //$currencyNumber = $service->convert($price, $currency);
        $this->monetaryManager->;
        $currencyNumber = "0.00";
        return $currencyNumber;
    }

    // for a service we need a name
    public function getName()
    {
        return 'currency_twig_extension';
    }
}