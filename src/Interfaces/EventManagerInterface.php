<?php

namespace PHPShots\Event\Interfaces;

use PHPShots\Event\EventArguments;

/**
 * Interface EventManagerInterface
 *
 * Defines the contract for an event manager, enabling 
 * the management of event listeners, dispatching, and middleware handling.
 *
 * @version 0.1.1
 */
interface EventManagerInterface
{
    /**
     * Adds a listener to an event with a specified priority.
     *
     * @param string $eventName The name of the event.
     * @param ListenerInterface $listener The listener instance.
     * @param int $priority Priority of the listener.
     */
    public function addListener(string $eventName, ListenerInterface $listener, int $priority = 0): void;

    /**
     * Adds a one-time listener to an event.
     *
     * @param string $eventName The name of the event.
     * @param ListenerInterface $listener The listener instance.
     */
    public function listenOnce(string $eventName, ListenerInterface $listener): void;

    /**
     * Dispatches an event to all listeners, with optional one-time execution.
     *
     * @param string $eventName The event name.
     * @param EventArguments $args The arguments to pass to the listeners.
     * @param bool $once If true, only dispatch one-time listeners.
     */
    public function dispatch(string $eventName, EventArguments $args, bool $once = false): void;
}
