<?php
/*
 * This file is part of the Extensions\System\Debug\DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extensions\System\Debug\DebugBar;

use Extensions\System\Debug\DebugBar\DataCollector\ExceptionsCollector;
use Extensions\System\Debug\DebugBar\DataCollector\MemoryCollector;
use Extensions\System\Debug\DebugBar\DataCollector\MessagesCollector;
use Extensions\System\Debug\DebugBar\DataCollector\PhpInfoCollector;
use Extensions\System\Debug\DebugBar\DataCollector\RequestDataCollector;
use Extensions\System\Debug\DebugBar\DataCollector\TimeDataCollector;

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
