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

namespace Vainyl\Cache;

use Vainyl\Core\NameableInterface;
use Psr\SimpleCache\CacheInterface as PsrCacheInterface;

/**
 * Interface CacheInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CacheInterface extends PsrCacheInterface, NameableInterface
{
}
