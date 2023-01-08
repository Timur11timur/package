<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Timur\Package\Transcription;

class TranscriptionTest extends TestCase
{
    /** @test */
    public function it_loads_vtt_file_as_a_string()
    {
        $file = __DIR__ . '/stubs/base-example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringContainsString('Here is an', $transcription);
        $this->assertStringContainsString('example of VTT file.', $transcription);
    }

    /** @test */
    public function it_can_convert_to_an_array_of_lines()
    {
        $file = __DIR__ . '/stubs/base-example.vtt';

        $this->assertCount(4, Transcription::load($file)->lines());
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_vtt_file()
    {
        $file = __DIR__ . '/stubs/base-example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', $transcription);
        $this->assertCount(4, $transcription->lines());
    }
}
