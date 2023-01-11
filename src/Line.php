<?php

namespace Timur\Package;

class Line
{
    private int $position;
    private string $timestamp;
    private string $body;

    public function __construct(int $position, string $timestamp, string $body)
    {
        $this->position = $position;
        $this->timestamp = $timestamp;
        $this->body = $body;
    }

    public function toAnchorTag(): string
    {
         return '<a href="?time=' . $this->beginningTimestamp() . '">' . $this->body . '</a>';
    }

    public function beginningTimestamp(): string
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);

        return $matches[1];
    }
}