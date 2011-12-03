<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Service\CurrencyExchanger;
 
/**
 * @author Richard Shank <develop@zestic.com>
 * @author Luis Cordova <cordoval@gmail.com>
 */
class OpenCurrencyExchanger extends CurrencyExchanger
{
    protected $openObject = null;

    public function __construct()
    {
        $this->openObject = $this->getExchangeRates();
    }

    /**
     * @inheritdoc
     */
    public function getExchangeRate($from, $to, \DateTime $datetime=null)
    {
        $from = $this->extractCode($from);
        $to = $this->extractCode($to);

        if ($this->isCachedExpired() || $this->openObject == null) {
            $this->openObject = $this->getExchangeRates();
        }

        $to = $this->openObject->rates->$to; // EUR
        $from = $this->openObject->rates->$from; // PEN
        $rate = bcdiv($from, $to, 8); // PEN/USD (26) / EUR/USD (7)
        return $rate;
    }

    public function getExchangeRates()
    {
        $url = "http://openexchangerates.org/latest.php";
        $openObject = json_decode(file_get_contents($url));
        return $openObject;
    }

    public function isCacheExpired()
    {
        if ($this->openObject->timestamp) {
            return false;
        } else {
            return true;
        }
    }
}