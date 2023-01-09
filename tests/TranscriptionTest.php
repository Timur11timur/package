<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Timur\Package\Line;
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
    public function it_can_convert_to_an_array_of_line_objects()
    {
        $file = __DIR__ . '/stubs/base-example.vtt';

        $lines = Transcription::load($file)->lines();

        $this->assertCount(2, $lines);

        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_vtt_file()
    {
        $file = __DIR__ . '/stubs/base-example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', $transcription);
        $this->assertCount(2, $transcription->lines());
    }

    /** @test */
    public function it_renders_the_line_as_html()
    {
        $file = __DIR__ . '/stubs/base-example.vtt';

        $transcription = Transcription::load($file);

        $expected = <<<EOT
<a href="?time=00:01">Here is an</a>
<a href="?time=00:04">example of VTT file.</a>
EOT;

        $this->assertEquals($expected, $transcription->htmlLines());
    }
}
