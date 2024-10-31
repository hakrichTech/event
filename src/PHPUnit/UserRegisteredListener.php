<?php

namespace PHPShots\Event\PHPUnit;

use PHPShots\Event\EventArguments;
use PHPShots\Event\Interfaces\ListenerInterface;

/**
 * UserRegisteredListener
 *
 * This subscriber listens to the 'user.registered' event and
 * performs actions such as sending a welcome email to the user.
 *
 * @version 0.1.1
 */
class UserRegisteredListener implements ListenerInterface
{
    /**
     * Handles the user.registered event.
     *
     * @param string $eventName The name of the event being dispatched.
     * @param EventArguments $args Arguments associated with the event.
     *
     * @return void
     */
    public function handle(string $eventName, EventArguments $user): void
    {
        // Extract user details from event arguments
        $username = $user->get('username');
        $email = $user->get('email');

        // Perform the action - in this case, sending a welcome email
        $this->sendWelcomeEmail($username, $email);
    }

    /**
     * Sends a welcome email to the user.
     *
     * @param string $username The username of the registered user.
     * @param string $email The email address of the registered user.
     *
     * @return void
     */
    private function sendWelcomeEmail(string $username, string $email): void
    {
        // Simulate sending an email (this would be replaced with actual email logic)
        echo "Welcome email sent to {$username} at {$email}\n";
    }
}
