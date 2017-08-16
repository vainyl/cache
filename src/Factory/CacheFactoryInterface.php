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

namespace Vainyl\Cache\Factory;

use Vainyl\Cache\CacheInterface;
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface CacheFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CacheFactoryInterface extends IdentifiableInterface
{
    /**
     * @param string $cacheName
     * @param string $connectionName
     * @param array  $options
     *
     * @return CacheInterface
     */
    public function createCache(string $cacheName, string $connectionName, array $options = []): CacheInterface;
}