<?php
/*
 * This file is part of the Continut\Extensions\System\Debug\DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Continut\Extensions\System\Debug\DebugBar;

interface RequestIdGeneratorInterface
{
    /**
     * Generates a unique id for the current request
     *
     * @return string
     */
    function generate();
}
