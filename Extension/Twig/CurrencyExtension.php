<?php

namespace Vespolina\MonetaryBundle\Extension\Twig;

class CurrencyTwigExtension extends \Twig_Extension
{
    // the magic function that makes this easy
    public function getFilters()
    {
        return array(
            'currency_convert'  => new \Twig_Filter_Function('currency_convert'),
        );
    }

    // your custom function
    public function currency_convert($price, $currency)
    {
        //$currencyNumber = $service->convert($price, $currency);
        $currencyNumber = "0.00";
        return $currencyNumber;
    }

    // for a service we need a name
    public function getName()
    {
        return 'currency_twig_extension';
    }
}