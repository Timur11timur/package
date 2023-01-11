<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Fralik\Package\Line;
use Fralik\Package\Transcription;

class TranscriptionTest extends TestCase
{
    private Transcription $transcription;

    protected function setUp(): void
    {
        $this->transcription = Transcription::load(__DIR__ . '/stubs/base-example.vtt');
    }

    /** @test */
    public function it_loads_vtt_file_as_a_string()
    {
        $this->assertStringContainsString('Here is an', $this->transcription);
        $this->assertStringContainsString('example of VTT file.', $this->transcription);
    }

    /** @test */
    public function it_can_convert_to_an_array_of_line_objects()
    {
        $lines = $this->transcription->lines();

        $this->assertCount(2, $lines);

        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_vtt_file()
    {
        $this->assertStringNotContainsString('WEBVTT', $this->transcription);
        $this->assertCount(2, $this->transcription->lines());
    }

    /** @test */
    public function it_renders_the_line_as_html()
    {
        $expected = <<<EOT
            <a href="?time=00:01">Here is an</a>
            <a href="?time=00:04">example of VTT file.</a>
            EOT;

        $this->assertEquals($expected, $this->transcription->lines()->asHtml());
    }
}
