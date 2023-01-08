<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Timur\Package\Transcription;

class TranscriptionTest extends TestCase
{ 
    /** @test */
    public function it_loads_vtt_file()
    {
        $transcription = Transcription::load(__DIR__ . '/stubs/base-example.vtt');

        $expected = file_get_contents(__DIR__ . '/stubs/base-example.vtt');

        $this->assertEquals($expected, $transcription);
    }
}