<?php
/*
 * This file is part of the Continut\Extensions\System\Debug\DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Continut\Extensions\System\Debug\DebugBar\DataCollector;

/**
 * Indicates that a DataCollector is renderable using JavascriptRenderer
 */
interface Renderable
{
    /**
     * Returns a hash where keys are control names and their values
     * an array of options as defined in {@see Continut\Extensions\System\Debug\DebugBar\JavascriptRenderer::addControl()}
     *
     * @return array
     */
    function getWidgets();
}
