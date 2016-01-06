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

use Continut\Extensions\System\Debug\DebugBar\DataCollector\ExceptionsCollector;
use Continut\Extensions\System\Debug\DebugBar\DataCollector\MemoryCollector;
use Continut\Extensions\System\Debug\DebugBar\DataCollector\MessagesCollector;
use Continut\Extensions\System\Debug\DebugBar\DataCollector\PhpInfoCollector;
use Continut\Extensions\System\Debug\DebugBar\DataCollector\RequestDataCollector;
use Continut\Extensions\System\Debug\DebugBar\DataCollector\TimeDataCollector;

/**
 * Debug bar subclass which adds all included collectors
 */
class StandardDebugBar extends DebugBar
{
    public function __construct()
    {
        $this->addCollector(new PhpInfoCollector());
        $this->addCollector(new MessagesCollector());
        $this->addCollector(new RequestDataCollector());
        $this->addCollector(new TimeDataCollector());
        $this->addCollector(new MemoryCollector());
        $this->addCollector(new ExceptionsCollector());
    }
}
