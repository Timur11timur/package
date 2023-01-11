<?php

namespace Timur\Package;

class Transcription
{
    private array $lines;

    public function __construct(array $lines)
    {
        $this->lines = array_slice(array_filter(array_map('trim', $lines)), 1);
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }

    public static function load(string $path): self
    {
        return new static(file($path));
    }

    public function lines(): Lines
    {
        return new Lines(array_map(function ($line) {
            return new Line(...$line);
        }, array_chunk($this->lines, 3)));
    }
}
