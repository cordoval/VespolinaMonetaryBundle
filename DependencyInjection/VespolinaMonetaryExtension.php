<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\MonetaryBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Symfony\Component\Config\Definition\Processor;

/**
 * @author Richard Shank <develop@zestic.com>
 * @author Luis Cordova <cordoval@gmail.com>
 */
class VespolinaMonetaryExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('monetary.xml');

        $this->configureBaseCurrency($config, $container);
    }

    protected function configureBaseCurrency(array $config, ContainerBuilder $container)
    {
        if (isset($config['currency'])) {
            $currencyConfig = $config['currency'];
            if (isset($currencyConfig['base_currency'])) {
                if (!in_array(strtoupper($currencyConfig['base_currency']), array('EUR'))) { // @todo hard coded for now
                    throw new \InvalidArgumentException(sprintf('Invalid currency code "%s".', $currencyConfig['base_currency']));
                }
                $container->setParameter('vespolina_monetary.base_currency', $currencyConfig['base_currency']);
            }
        }
    }
}