<?php
namespace Currencies;

use Vespolina\MonetaryBundle\Model\Currency;
/**
 * Auto-generated Currency
 */
class XTSCurrency extends Currency
{
    public function getCurrencyCode()
    {
        return 'XTS';
    }

    public function getName()
    {
        return 'Codes specifically reserved for testing purposes';
    }

    public function getPrecision()
    {
        return 0;
    }

    public function getShortName()
    {
        return 'Codes specifically reserved for testing purposes';
    }

    public function getSymbol()
    {
        return '';
    }

    public function formatAmount($amount)
    {
        return $this->getSymbol() . $this->rounding($amount);
    }

    protected function rounding($amount)
    {
        $roundUp = '.'.substr('0000000000000005', -($this->getPrecision() + 1));
        return bcadd((string)$amount, $roundUp, $this->getPrecision());
    }
}