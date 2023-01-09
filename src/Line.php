<?php

namespace Timur\Package;

class Line
{
    private string $timestamp;
    private string $body;

    public function __construct(string $timestamp, string $body)
    {
        $this->timestamp = $timestamp;
        $this->body = $body;
    }

    public static function valid(string $line): bool
    {
        return $line !== 'WEBVTT' && $line !== '' && ! is_numeric($line);
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