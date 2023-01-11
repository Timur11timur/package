<?php

namespace Timur\Package;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class Lines implements Countable, IteratorAggregate
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
}