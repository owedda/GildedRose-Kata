<?php

declare(strict_types=1);

namespace Tests\Unit\GildedRose\Cases;

use GildedRose\GildedRose\Cases\AgedBrieCase;
use GildedRose\GildedRose\GildedRoseConstants;
use GildedRose\Models\Item;
use PHPUnit\Framework\TestCase;

class AgedBrieCaseTest extends TestCase
{
    public function testWhenSellInLessThen1AndQualityLessThen50AddsQualityPlus1True(): void
    {
        $item = new Item(GildedRoseConstants::AGED_BRIE, 0, 49);
        $case = new AgedBrieCase();

        $case->updateQualityByRules($item);

        self::assertSame(50, $item->getQuality());
    }

    public function testWhenNameIsAgedBrieSellInLessThen1AndQualityLessThen49AddsQualityPlus2True(): void
    {
        $item = new Item(GildedRoseConstants::AGED_BRIE, 0, 48);
        $case = new AgedBrieCase();

        $case->updateQualityByRules($item);

        self::assertSame(50, $item->getQuality());
    }

    public function testWhenNameIsAgedBrieSellInMoreThen0AndQualityLessThen49AddsQualityPlus1True(): void
    {
        $item = new Item(GildedRoseConstants::AGED_BRIE, 1, 48);
        $case = new AgedBrieCase();

        $case->updateQualityByRules($item);

        self::assertSame(49, $item->getQuality());
    }

    public function testWhenNameIsAgedBrieAndQualityMoreThen49AddsQualityNothingTrue(): void
    {
        $item = new Item(GildedRoseConstants::AGED_BRIE, 0, 50);
        $case = new AgedBrieCase();

        $case->updateQualityByRules($item);

        self::assertSame(50, $item->getQuality());
    }
}
