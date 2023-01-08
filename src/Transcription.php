<?php

namespace Timur\Package;

class Transcription
{
    private array $lines;

    public static function load(string $path): self
    {
        $instance = new static();

        $instance->lines = $instance->discardIrrelevantLines(file($path));

        return $instance;
    }

    public function lines(): array
    {
        return $this->lines;
    }

    public function __toString(): string
    {
        return implode("", $this->lines);
    }

    private function discardIrrelevantLines(array $lines): array
    {
        $lines = array_map('trim', $lines);

        return array_values(array_filter($lines, function ($line) {
            return $line !== 'WEBVTT' && $line !== '' && ! is_numeric($line);
        }));
    }
}
