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
use Psr\Cache\CacheItemPoolInterface;

class FileCachePool implements CacheItemPoolInterface
{
    /**
     * Location where our File cache is to be stored
     */
    const CACHE_DIR = DS . 'Cache' . DS . 'Content' . DS;

    /**
     * @var int Default lifetime for each cache item, in seconds
     */
    protected $lifetime = 3600;

    /**
     * @var CacheItemInterface[]
     */
    private $items;
    /**
     * @var CacheItemInterface[]
     */
    private $deferredItems;

    /**
     * {@inheritdoc}
     */
    public function getItem($key)
    {
        return current($this->getItems([$key]));
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(array $keys = array())
    {
        $foundItems = [];

        foreach ($keys as $key) {
            $this->validateKey($key);
            $foundItems[$key] = $this->getItem($key);
            if ($this->hasItem($key)) {
                $foundItems[$key] = clone $this->items[$key];
            } else {
                $foundItems[$key] = new FileCacheItem($key);
                $filename = __ROOTCMS__ . self::CACHE_DIR . $key;
                if (file_exists($filename)) {
                    $foundItems[$key]->set(file_get_contents($filename));
                } else {
                    $foundItems[$key]->set('invalid cache file');
                }
            }
        }

        return $foundItems;
    }

    /**
     * {@inheritdoc}
     */
    public function hasItem($key)
    {
        $this->validateKey($key);

        return isset($this->items[$key]) && $this->items[$key]->isHit();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->items = [];
        $this->deferredItems = [];

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItem($key)
    {
        return $this->deleteItems([$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItems(array $keys)
    {
        array_walk($keys, [$this, 'validateKey']);

        foreach ($keys as $key) {
            unset($this->items[$key]);
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function save(CacheItemInterface $item)
    {
        $filename = __ROOTCMS__ . self::CACHE_DIR . $item->getKey();

        if (file_put_contents($filename, $item->get())) {
            $this->items[$item->getKey()] = $item;
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function saveDeferred(CacheItemInterface $item)
    {
        $this->deferredItems[$item->getKey()] = $item;
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        foreach ($this->deferredItems as $item) {
            $this->save($item);
        }
        $this->deferredItems = [];

        return true;
    }

    /**
     * @param $key
     * @return bool
     */
    private function validateKey($key)
    {
        if (!is_string($key) || preg_match("#[{}()/\\\\@:]#", $key)) {
            throw new InvalidArgumentException('You have used an invalid cache key: ' . var_export($key, true));
        }
        return true;
    }
}
