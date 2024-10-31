<?php

namespace PHPShots\Event;

use PHPShots\Event\Interfaces\EventManagerInterface;
use PHPShots\Event\Interfaces\ListenerInterface;
use RuntimeException;
use InvalidArgumentException;

/**
 * EventManager
 *
 * Manages events by allowing listeners to register and respond to events.
 * Supports one-time and priority-based listeners for optimized event handling.
 *
 * @version 0.1.1
 */
class EventManager implements EventManagerInterface
{
    /**
     * @var array Holds listeners indexed by event name.
     */
    private array $listeners = [];

    /**
     * Adds a listener to an event with a specified priority.
     *
     * @param string $eventName The name of the event.
     * @param ListenerInterface $listener The listener instance.
     * @param int $priority Priority of the listener.
     */
    public function addListener(string $eventName, ListenerInterface $listener, int $priority = 0): void
    {
        $hash = spl_object_hash($listener);

        // Check for existing listener for the event.
        if (isset($this->listeners[$eventName][$hash])) {
            throw new RuntimeException("Listener already registered for event: {$eventName}");
        }

        // Register listener with priority sorting.
        $this->listeners[$eventName][$priority][] = $listener;
        krsort($this->listeners[$eventName]); // Sort by priority in descending order
    }

    /**
     * Adds a one-time listener to an event.
     *
     * @param string $eventName The name of the event.
     * @param ListenerInterface $listener The listener instance.
     */
    public function listenOnce(string $eventName, ListenerInterface $listener): void
    {
        $this->addListener($eventName, new class($listener) implements ListenerInterface {
            private ListenerInterface $originalListener;

            public function __construct(ListenerInterface $listener)
            {
                $this->originalListener = $listener;
            }

            public function handle(string $eventName, EventArguments $args): void
            {
                $this->originalListener->handle($eventName, $args);
                $this->originalListener = null; // Ensure this only triggers once
            }
        });
    }

    /**
     * Dispatches an event to all listeners, with optional one-time execution.
     *
     * @param string $eventName The event name.
     * @param EventArguments $args The arguments passed to listeners.
     * @param bool $once If true, only dispatch one-time listeners.
     */
    public function dispatch(string $eventName, EventArguments $args, bool $once = false): void
    {
        if (empty($this->listeners[$eventName])) {
            throw new InvalidArgumentException("No listeners for event: {$eventName}");
        }

        foreach ($this->listeners[$eventName] as $priority => $listeners) {
            foreach ($listeners as $key => $listener) {
                if ($once && !$listener instanceof ListenerInterface) continue;
                $listener->handle($eventName, $args);
            }
        }
    }
}
