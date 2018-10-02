<?php

namespace App\Tests\Integration;

use App\Exceptions\WrongInputFilePathException;
use App\Services\Input\MatchReader;
use PHPUnit\Framework\TestCase;

abstract class MatchReaderTest extends TestCase {

    protected $inputFilePath;
    /** @var MatchReader */
    protected $matchReader;

    public function testConstructor() {
        $this->assertEquals($this->inputFilePath, $this->matchReader->getInputFilePath());
    }

    public function testWrongInputFilePath() {
        $this->expectException(WrongInputFilePathException::class);

        new MatchReader('/path/to/wrong/input/file');
    }
}