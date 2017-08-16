<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Cache
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Cache\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Cache\CacheInterface;
use Vainyl\Core\Exception\MissingRequiredFieldException;
use Vainyl\Core\Exception\MissingRequiredServiceException;
use Vainyl\Core\Extension\AbstractCompilerPass;

/**
 * Class DatabaseCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CacheCompilerPass extends AbstractCompilerPass
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === ($container->hasDefinition('cache.storage'))) {
            throw new MissingRequiredServiceException($container, 'cache.storage');
        }

        $services = $container->findTaggedServiceIds('cache');
        foreach ($services as $id => $tags) {
            foreach ($tags as $attributes) {
                if (false === array_key_exists('alias', $attributes)) {
                    throw new MissingRequiredFieldException($container, $id, $attributes, 'alias');
                }
                $name = $attributes['alias'];
                $definition = $container->getDefinition($id);
                $inner = $id . '.inner';
                $container->setDefinition($inner, $definition);

                $containerDefinition = $container->getDefinition('cache.storage');
                $containerDefinition
                    ->addMethodCall('addCache', [$name, new Reference($inner)]);

                $decoratedDefinition = (new Definition())
                    ->setClass(CacheInterface::class)
                    ->setFactory([new Reference('cache.storage'), 'getCache'])
                    ->setArguments([$name]);

                $container->setDefinition($id, $decoratedDefinition);
            }
        }

        return $this;
    }
}
