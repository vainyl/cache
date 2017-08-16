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
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface CacheStorageInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CacheStorageInterface extends IdentifiableInterface
{
    /**
     * @param string         $alias
     * @param CacheInterface $cache
     *
     * @return $this
     */
    public function addCache(string $alias, CacheInterface $cache);

    /**
     * @param string $alias
     *
     * @return CacheInterface
     */
    public function getDatabase(string $alias): CacheInterface;
}