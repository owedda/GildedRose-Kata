<?php

declare(strict_types=1);

namespace Tests\Unit\GildedRose\Cases;

use GildedRose\GildedRose\Cases\OtherCases;
use GildedRose\Models\Item;
use PHPUnit\Framework\TestCase;

class OtherCasesTest extends TestCase
{
    public function testWhenNameIsAnyAndQualityMoreThen0MinusQuality1True(): void
    {
        $item = new Item('TEST', 1, 1);
        $case = new OtherCases();

        $case->updateQualityByRules($item);

        self::assertSame(0, $item->getQuality());
    }

    public function testWhenNameIsAnyAndQualityLessThen1MinusQuality0True(): void
    {
        $item = new Item('TEST', 1, 0);
        $case = new OtherCases();

        $case->updateQualityByRules($item);

        self::assertSame(0, $item->getQuality());
    }

    public function testWhenNameIsAnyAndSellInLessThen1AndQualityMoreThen1MinusQuality2True(): void
    {
        $item = new Item('TEST', 0, 2);
        $case = new OtherCases();

        $case->updateQualityByRules($item);

        self::assertSame(0, $item->getQuality());
    }
}
