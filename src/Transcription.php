<?php

namespace Timur\Package;

class Transcription
{
    private array $lines;

    public function __construct(array $lines)
    {
        $this->lines = $this->discardInvalidLines(array_map('trim', $lines));
    }

    public function __toString(): string
    {
        return implode("", $this->lines);
    }

    public static function load(string $path): self
    {
        return new static(file($path));
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
        return array_values(array_filter($lines, function ($line) {
            return Line::valid($line);
        }));
    }
}
