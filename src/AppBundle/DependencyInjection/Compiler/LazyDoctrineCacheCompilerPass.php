<?php

namespace AppBundle\DependencyInjection\Compiler; 

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LazyDoctrineCacheCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $cacheProviderIds = array(
            'doctrine_cache.providers.doctrine.orm.default_metadata_cache',
            'doctrine_cache.providers.phpcr_meta',
            'doctrine_cache.providers.phpcr_nodes',
            'doctrine_cache.providers.sylius_rbac',
            'doctrine_cache.providers.sylius_settings'
        );

        foreach ($cacheProviderIds as $id) {
            $container->getDefinition($id)->setLazy(true);
        }
    }
}
