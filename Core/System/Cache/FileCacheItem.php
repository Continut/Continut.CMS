<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 07.04.2015 @ 11:22
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Cache;

use Psr\Cache\CacheItemInterface;

class FileCacheItem implements CacheItemInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var bool
     */
    protected $isHit;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var \DateTime
     */
    protected $expiration;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function isHit()
    {
        if (!$this->isHit) {
            return false;
        }
        if ($this->expiration === null) {
            return true;
        }
        return new \DateTime() < $this->expiration;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return $this->isHit() ? $this->value : null;
    }

    /**
     * {@inheritdoc}
     */
    public function set($value)
    {
        $this->isHit = true;
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function expiresAt($expiration)
    {
        // TODO: Implement expiresAt() method.
    }

    /**
     * {@inheritdoc}
     */
    public function expiresAfter($time)
    {
        // TODO: Implement expiresAfter() method.
    }
}
