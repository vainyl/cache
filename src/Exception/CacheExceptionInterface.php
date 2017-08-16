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
use Vainyl\Core\Exception\CoreExceptionInterface;

/**
 * Interface CacheExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CacheExceptionInterface extends CoreExceptionInterface
{
    /**
     * @return CacheInterface
     */
    public function getCache(): CacheInterface;
}
