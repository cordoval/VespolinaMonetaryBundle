<?php
namespace Currencies;

use Vespolina\MonetaryBundle\Model\Currency;
/**
 * Auto-generated Currency
 */
class XXXCurrency extends Currency
{
    public function getCurrencyCode()
    {
        return 'XXX';
    }

    public function getName()
    {
        return 'The codes assigned for transactions where no name is involved';
    }

    public function getPrecision()
    {
        return 0;
    }

    public function getShortName()
    {
        return 'The codes assigned for transactions where no name is involved';
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