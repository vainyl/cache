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

namespace Vainyl\Cache\Exception;

use Vainyl\Cache\CacheInterface;
use Vainyl\Core\Exception\AbstractCoreException;

/**
 * Class AbstractCacheException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractCacheException extends AbstractCoreException implements CacheExceptionInterface
{
    private $cache;

    /**
     * AbstractCacheException constructor.
     *
     * @param CacheInterface $cache
     * @param string            $message
     * @param int               $code
     * @param \Exception|null   $previous
     */
    public function __construct(
        CacheInterface $cache,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->cache = $cache;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['cache' => $this->cache->getName()], parent::toArray());
    }

    /**
     * @inheritDoc
     */
    public function getCache(): CacheInterface
    {
        return $this->cache;
    }
}
