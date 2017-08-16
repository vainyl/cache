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

namespace Vainyl\Cache\Storage;

use Vainyl\Cache\CacheInterface;
use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;

/**
 * Class DatabaseStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CacheStorage extends AbstractStorageDecorator implements CacheStorageInterface
{
    /**
     * @inheritDoc
     */
    public function addCache(string $alias, CacheInterface $cache)
    {
        $this->offsetSet($alias, $cache);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getCache(string $alias): CacheInterface
    {
        return $this->offsetGet($alias);
    }
}
