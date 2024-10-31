<?php
namespace PHPShots\Event;

/**
 * Base class for event arguments with support for flexible, dynamic argument properties.
 *
 * @version 1.3.0
 */
class EventArguments {
    protected array $arguments = [];

    public function __construct(array $arguments = []) {
        $this->arguments = $arguments;
    }

    public function get(string $key) {
        return $this->arguments[$key] ?? null;
    }

    public function set(string $key, $value): void {
        $this->arguments[$key] = $value;
    }

    public function all(): array {
        return $this->arguments;
    }
}
