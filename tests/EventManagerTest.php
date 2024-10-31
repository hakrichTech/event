<?php

namespace PHPShots\Event\Tests;

use PHPUnit\Framework\TestCase;
use PHPShots\Event\EventManager;
use PHPShots\Event\EventArguments;
use PHPShots\Event\PHPUnit\UserRegisteredListener;

class EventManagerTest extends TestCase
{
    private EventManager $eventManager;

    protected function setUp(): void
    {
        $this->eventManager = new EventManager();
    }

    public function testListenerHandlesEvent(): void
    {
        $listener = new UserRegisteredListener();
        $this->eventManager->addListener('user.registered', $listener);

        $args = new EventArguments(['username' => 'JohnDoe', 'email' => 'john.doe@example.com']);

        ob_start();
        $this->eventManager->dispatch('user.registered', $args);
        $output = ob_get_clean();

        $this->assertStringContainsString(
            "Welcome email sent to JohnDoe at john.doe@example.com",
            $output
        );
    }
}
