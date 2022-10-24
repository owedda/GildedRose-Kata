<?php

declare(strict_types=1);

namespace Tests\Unit\GildedRose\Cases;

use GildedRose\GildedRose\Cases\TafkalCase;
use GildedRose\GildedRose\GildedRoseConstants;
use GildedRose\Models\Item;
use PHPUnit\Framework\TestCase;

class TafkalCaseTest extends TestCase
{
    public function testWhenQualityMoreThen49AddsQuality1True(): void
    {
        $item = new Item(GildedRoseConstants::TAFKAL80ETC, 1, 50);
        $case = new TafkalCase();

        $case->updateQualityByRules($item);

        self::assertSame(50, $item->getQuality());
    }

    public function testWhenSellInMoreThen11AndQualityLessThen50AddsQuality1True(): void
    {
        $item = new Item(GildedRoseConstants::TAFKAL80ETC, 12, 49);
        $case = new TafkalCase();

        $case->updateQualityByRules($item);

        self::assertSame(50, $item->getQuality());
    }

    public function testWhenSellInLessThen11AndQualityLessThen49AddsQuality2True(): void
    {
        $item = new Item(GildedRoseConstants::TAFKAL80ETC, 10, 48);
        $case = new TafkalCase();

        $case->updateQualityByRules($item);

        self::assertSame(50, $item->getQuality());
    }

    public function testWhenSellInLessThen6AndQualityLessThen48AddsQuality3True(): void
    {
        $item = new Item(GildedRoseConstants::TAFKAL80ETC, 5, 47);
        $case = new TafkalCase();

        $case->updateQualityByRules($item);

        self::assertSame(50, $item->getQuality());
    }

    public function testWhenSellInLessThen1AndQualityLessThen50QualityEquals0True(): void
    {
        $item = new Item(GildedRoseConstants::TAFKAL80ETC, 0, 49);
        $case = new TafkalCase();

        $case->updateQualityByRules($item);

        self::assertSame(0, $item->getQuality());
    }
}
