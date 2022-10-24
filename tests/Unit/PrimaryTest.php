<?php

declare(strict_types=1);

namespace Tests\Unit;

use GildedRose\GildedRose\Factories\GildedRoseCasesFactory;
use GildedRose\GildedRose\GildedRose;
use GildedRose\GildedRose\GildedRoseConstants;
use GildedRose\GildedRose\Services\AllCasesService;
use GildedRose\Models\Item;
use PHPUnit\Framework\TestCase;

class PrimaryTest extends TestCase
{
    private function setUpItem(): Item
    {
        return new Item("Test", 0, 0);
    }

    private function setUpGildedRose(array $items): GildedRose
    {
        return new GildedRose(new AllCasesService(new GildedRoseCasesFactory()), $items);
    }

    public function testIfNameDoesntChangeTrue(): void
    {
        $items = [$this->setUpItem(), new Item('foo', 0, 0)];
        $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame('foo', $items[1]->getName());
    }

    public function testWhenNameIsAgedBrieSellInLessThen1AndQualityLessThen50AddsQualityPlus1True(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::AGED_BRIE, 0, 49)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(50, $items[1]->getQuality());
    }

    public function testWhenNameIsAgedBrieSellInLessThen1AndQualityLessThen49AddsQualityPlus2True(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::AGED_BRIE, 0, 48)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(50, $items[1]->getQuality());
    }

    public function testWhenNameIsAgedBrieSellInMoreThen0AndQualityLessThen49AddsQualityPlus1True(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::AGED_BRIE, 1, 48)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(49, $items[1]->getQuality());
    }

    public function testWhenNameIsAgedBrieAndQualityMoreThen49AddsQualityNothingTrue(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::AGED_BRIE, 0, 50)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(50, $items[1]->getQuality());
    }

    public function testWhenNameIsTafkalAndQualityMoreThen49AddsQuality1True(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::TAFKAL80ETC, 1, 50)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(50, $items[1]->getQuality());
    }

    public function testWhenNameIsTafkalAndSellInMoreThen11AndQualityLessThen50AddsQuality1True(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::TAFKAL80ETC, 12, 49)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(50, $items[1]->getQuality());
    }

    public function testWhenNameIsTafkalAndSellInLessThen11AndQualityLessThen49AddsQuality2True(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::TAFKAL80ETC, 10, 48)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(50, $items[1]->getQuality());
    }

    public function testWhenNameIsTafkalAndSellInLessThen6AndQualityLessThen48AddsQuality3True(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::TAFKAL80ETC, 5, 47)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(50, $items[1]->getQuality());
    }

    public function testWhenNameIsTafkalAndSellInLessThen1AndQualityLessThen50QualityEquals0True(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::TAFKAL80ETC, 0, 49)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(0, $items[1]->getQuality());
    }

    public function testWhenNameIsNotSulfurasThenSellInIsMinusOneTrue(): void
    {
        $items = [$this->setUpItem(), new Item('TestTest', 0, 0)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(-1, $items[1]->getSellIn());
    }

    public function testWhenNameIsSulfurasThenSellInDoesntChangeTrue(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::SULFURAS, 0, 0)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(0, $items[1]->getSellIn());
    }

    public function testWhenNameIsSulfurasThenQualityDoesntChangeTrue(): void
    {
        $items = [$this->setUpItem(), new Item(GildedRoseConstants::SULFURAS, 0, 0)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(0, $items[1]->getQuality());
    }

    public function testWhenNameIsAnyAndQualityMoreThen0MinusQuality1True(): void
    {
        $items = [$this->setUpItem(), new Item('TEST', 1, 1)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(0, $items[1]->getQuality());
    }

    public function testWhenNameIsAnyAndQualityLessThen1MinusQuality0True(): void
    {
        $items = [$this->setUpItem(), new Item('TEST', 1, 0)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(0, $items[1]->getQuality());
    }

    public function testWhenNameIsAnyAndSellInLessThen1AndQualityMoreThen1MinusQuality2True(): void
    {
        $items = [$this->setUpItem(), new Item('TEST', 0, 2)];
         $gildedRose = $this->setUpGildedRose($items);

        $gildedRose->updateItemsByNames();

        self::assertSame(0, $items[1]->getQuality());
    }
}
