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

namespace Vainyl\Cache\Decorator;

use Psr\Log\LoggerInterface;
use Vainyl\Cache\CacheInterface;

/**
 * Class LoggerCacheDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerCacheDecorator extends AbstractCacheDecorator
{
    private $logger;

    /**
     * LoggerCacheDecorator constructor.
     *
     * @param CacheInterface  $cache
     * @param LoggerInterface $logger
     */
    public function __construct(CacheInterface $cache, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($cache);
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        $this->logger->debug(sprintf('Trying to clear cache %s with parameters (%s)', $this->getName()));
        $result = parent::clear();
        if ($result) {
            $this->logger->debug(sprintf('Cache %s successfully cleared', $this->getName()));
        } else {
            $this->logger->warning(sprintf('Failed to clear cache %s', $this->getName()));
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        $this->logger->debug(sprintf('Trying to delete key %s from cache %s', $key, $this->getName()));
        $result = parent::delete($key);
        if ($result) {
            $this->logger->debug(sprintf('Key %s was successfully delete from cache %s', $key, $this->getName()));
        } else {
            $this->logger->warning(sprintf('Failed to delete key %s from cache %s', $key, $this->getName()));
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple($keys)
    {
        $this->logger->debug(
            sprintf('Trying to delete keys [%s] from cache %s', implode(', ', $keys), $this->getName())
        );
        $result = parent::deleteMultiple($keys);
        if ($result) {
            $this->logger->debug(
                sprintf('Keys [%s] were successfully delete from cache %s', implode(', ', $keys), $this->getName())
            );
        } else {
            $this->logger->warning(
                sprintf('Failed to delete keys [%s] from cache %s', implode(', ', $keys), $this->getName())
            );
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        $this->logger->debug(
            sprintf('Trying to fetch key %s with default %s from cache %s', $key, $default, $this->getName())
        );
        $result = parent::get($key, $default);
        if ($result) {
            $this->logger->debug(sprintf('Key %s was successfully fetched from cache %s', $key, $this->getName()));
        } else {
            $this->logger->warning(sprintf('Failed to fetch key %s from cache %s', $key, $this->getName()));
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getMultiple($keys, $default = null)
    {
        $this->logger->debug(
            sprintf('Trying to fetch keys [%s] from cache %s', implode(', ', $keys), $this->getName())
        );
        $result = parent::getMultiple($keys, $default);
        if ($result) {
            $this->logger->debug(
                sprintf('Keys [%s] were successfully fetched from cache %s', implode(', ', $keys), $this->getName())
            );
        } else {
            $this->logger->warning(
                sprintf('Failed to fetch keys [%s] from cache %s', implode(', ', $keys), $this->getName())
            );
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        $this->logger->debug(sprintf('Checking existense for key %s from cache %s', $key, $this->getName()));
        $result = parent::has($key);
        if ($result) {
            $this->logger->debug(sprintf('Key %s is available in cache %s', $key, $this->getName()));
        } else {
            $this->logger->debug(sprintf('Key %s is absent in cache %s', $key, $this->getName()));
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null)
    {
        $this->logger->debug(
            sprintf('Trying to set key %s to %s with ttl %d from cache %s', $key, $value, (int)$ttl, $this->getName())
        );
        $result = parent::set($key, $value, $ttl);
        if ($result) {
            $this->logger->debug(sprintf('Key %s was successfully stored in cache %s', $key, $this->getName()));
        } else {
            $this->logger->warning(sprintf('Failed to store key %s in cache %s', $key, $this->getName()));
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function setMultiple($values, $ttl = null)
    {
        $this->logger->debug(
            sprintf('Trying to set keys [%s] from cache %s', implode(', ', $values), $this->getName())
        );
        $result = parent::setMultiple($values, $ttl);
        if ($result) {
            $this->logger->debug(
                sprintf('Keys [%s] were successfully stored in cache %s', implode(', ', $values), $this->getName())
            );
        } else {
            $this->logger->warning(
                sprintf('Failed to store keys [%s] in cache %s', implode(', ', $values), $this->getName())
            );
        }

        return $result;
    }
}
