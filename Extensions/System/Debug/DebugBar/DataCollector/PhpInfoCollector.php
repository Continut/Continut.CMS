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
 * Collects info about PHP
 */
class PhpInfoCollector extends DataCollector
{
    public function collect()
    {
        return array(
            'version' => PHP_VERSION
        );
    }

    public function getName()
    {
        return 'php';
    }
}