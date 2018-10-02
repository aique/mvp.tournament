<?php

namespace App\Tests\Unit\Classes\Services\Input;

use App\Exceptions\WrongDataFileFormatException;
use App\Services\Input\Parse\BasketballStatsFileFileParser;
use App\Services\Input\Parse\HandballStatsFileFileParser;
use App\Services\Input\Parse\InputStatsFileParserFactory;
use PHPUnit\Framework\TestCase;

class InputStatsFileParserFactoryTest extends TestCase {

    private $inputStatsLine;
    /** @var InputStatsFileParserFactory */
    private $inputStatsFileParserFactory;

    public function setUp() {
        $this->inputStatsLine = 'player​ ​ 1;nick1;4;Team​ ​ A;G;10;2;7';
        $this->inputStatsFileParserFactory = new InputStatsFileParserFactory($this->inputStatsLine);
    }

    public function testConstructor() {
        $this->assertEquals($this->inputStatsLine, $this->inputStatsFileParserFactory->getInputStatsLine());
    }

    public function testBasketballParserCreated() {
        $this->assertEquals(new BasketballStatsFileFileParser(), $this->inputStatsFileParserFactory->createFileParser());
    }

    public function testHandballParserCreated() {
        $inputStatsLine = 'player​ ​ 1;nick1;4;Team​ ​ A;G;0;20';
        $this->inputStatsFileParserFactory->setInputStatsLine($inputStatsLine);
        $this->assertEquals(new HandballStatsFileFileParser(), $this->inputStatsFileParserFactory->createFileParser());
    }

    public function testUnrecognizedStatsType() {
        $this->expectException(WrongDataFileFormatException::class);

        $inputStatsLine = 'player​ ​ 1;nick1;4;Team​ ​ A;G;0';
        $this->inputStatsFileParserFactory->setInputStatsLine($inputStatsLine);
        $this->inputStatsFileParserFactory->createFileParser();
    }
}