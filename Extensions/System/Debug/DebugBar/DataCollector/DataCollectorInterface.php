<?php
/*
 * This file is part of the Extensions\System\Debug\DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extensions\System\Debug\DebugBar\DataCollector;

/**
 * DataCollector Interface
 */
interface DataCollectorInterface
{
    /**
     * Called by the Extensions\System\Debug\DebugBar when data needs to be collected
     *
     * @return array Collected data
     */
    function collect();

    /**
     * Returns the unique name of the collector
     *
     * @return string
     */
    function getName();
}
