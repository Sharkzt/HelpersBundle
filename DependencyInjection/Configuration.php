<?php

namespace Sharkzt\HelpersBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from app/config files.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sharkzt_helpers');
        $rootNode
            ->children()
                ->scalarNode('validator_interface')
                    ->defaultValue('validator_interface')
                    ->cannotBeEmpty()
                ->end()
        ;

        return $treeBuilder;
    }
}
