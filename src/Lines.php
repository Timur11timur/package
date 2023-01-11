<?php

namespace Fralik\Package;

class Lines extends Collection
{
    public function __toString(): string
    {
        return implode("\n", $this->items);
    }

    public function asHtml(): string
    {
        return $this->map(fn(Line $line) => $line->toAnchorTag())->__toString();
    }
}