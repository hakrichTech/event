<?php

namespace PHPShots\Event\Interfaces;

use PHPShots\Event\EventArguments;

/**
 * ListenerInterface
 *
 * Represents a listener that can respond to an event.
 *
 * @version 0.1.1
 */
interface ListenerInterface
{
    /**
     * Handles an event when triggered.
     *
     * @param string $eventName The name of the event.
     * @param EventArguments $args The arguments for the event.
     */
    public function handle(string $eventName, EventArguments $args): void;
}
