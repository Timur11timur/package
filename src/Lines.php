<?php

namespace Fralik\Package;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

class Lines implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    private array $lines;

    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }

    public function asHtml(): string
    {
        $formattedLines = array_map(function (Line $line) {
                return $line->toAnchorTag();
            }, $this->lines);

        return (new static($formattedLines))->__toString();
    }

    public function count(): int
    {
        return count($this->lines);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->lines);
    }

    public function offsetExists(mixed $key): bool
    {
        return isset($this->lines[$key]);
    }

    public function offsetGet(mixed $key): mixed
    {
        return $this->lines[$key];
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        if (is_null($key)) {
            $this->lines[] = $value;
        } else {
            $this->lines[$key] = $value;
        }
    }

    public function offsetUnset(mixed $key): void
    {
        unset($this->lines[$key]);
    }

    public function jsonSerialize(): mixed
    {
        return $this->lines;
    }
}