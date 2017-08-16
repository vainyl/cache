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
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\AbstractFrameworkExtension;

/**
 * Class DatabaseExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CacheExtension extends AbstractFrameworkExtension
{
    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [[new CacheCompilerPass()]];
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        parent::load($configs, $container);

        $configuration = new CacheConfiguration();
        $caches = $this->processConfiguration($configuration, $configs);

        foreach ($caches as $name => $config) {
            $databaseId = 'cache.' . $name;
            $factoryId = 'cache.factory.' . $config['driver'];
            $definition = (new Definition())
                ->setClass(CacheInterface::class)
                ->setFactory([new Reference($factoryId), 'createCache'])
                ->setArguments(
                    [
                        $name,
                        $config['connection'],
                        $config['options'],
                    ]
                )
                ->addTag('cache', ['alias' => $name])
                ->addTag('cache.' . $config['driver'], ['alias' => $name]);
            $container->setDefinition($databaseId, $definition);
        }

        return $this;
    }
}