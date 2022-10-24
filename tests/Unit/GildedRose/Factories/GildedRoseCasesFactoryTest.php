<?php

declare(strict_types=1);

namespace Tests\Unit\GildedRose\Factories;

use GildedRose\GildedRose\Cases\AgedBrieCase;
use GildedRose\GildedRose\Cases\OtherCases;
use GildedRose\GildedRose\Cases\TafkalCase;
use GildedRose\GildedRose\Factories\GildedRoseCasesFactory;
use GildedRose\GildedRose\GildedRoseConstants;
use PHPUnit\Framework\TestCase;

class GildedRoseCasesFactoryTest extends TestCase
{
    public function testWhenCaseIsAgedBrieEqualsTrue(): void
    {
        $factory = new GildedRoseCasesFactory();
        $expected = new AgedBrieCase();

        $actual = $factory->getGildedRoseCase(GildedRoseConstants::AGED_BRIE);

        $this->assertEquals($expected, $actual);
    }

    public function testWhenCaseIsTafkalEqualsTrue(): void
    {
        $factory = new GildedRoseCasesFactory();
        $expected = new TafkalCase();

        $actual = $factory->getGildedRoseCase(GildedRoseConstants::TAFKAL80ETC);

        $this->assertEquals($expected, $actual);
    }

    public function testWhenCaseIsOtherEqualsTrue(): void
    {
        $factory = new GildedRoseCasesFactory();
        $expected = new OtherCases();
        $name = "test";

        $actual = $factory->getGildedRoseCase($name);

        $this->assertEquals($expected, $actual);
    }
}
