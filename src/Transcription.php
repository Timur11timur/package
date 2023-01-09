<?php

namespace Timur\Package;

class Transcription
{
    private array $lines;

    public function __toString(): string
    {
        return implode("", $this->lines);
    }

    public static function load(string $path): self
    {
        $instance = new static();

        $instance->lines = $instance->discardInvalidLines(file($path));

        return $instance;
    }

    public function lines(): array
    {
        $result = [];
        for ($i = 0; $i < count($this->lines); $i += 2) {
            $result[] = new Line($this->lines[$i], $this->lines[$i + 1]);
        }

        return $result;
    }

    private function discardInvalidLines(array $lines): array
    {
        $lines = array_map('trim', $lines);

        return array_values(array_filter($lines, function ($line) {
            return Line::valid($line);
        }));
    }
}
