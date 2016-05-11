<?php

namespace Choros\UserInterface\Symfony\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;


class ChorosExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadProoph($container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));
        $loader->load('services.yml');
    }

    private function loadProoph(ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config/prooph'));
        $loader->load('service_bus.xml');
        //$loader->load('event_store.xml');

        $loader = new Loader\PhpFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config/prooph'));
        $loader->load('config.php');
    }
}
