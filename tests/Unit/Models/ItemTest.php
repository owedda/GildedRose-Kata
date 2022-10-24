<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use GildedRose\Models\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    private function setUpItem(): Item
    {
        return new Item("Test", 0, 0);
    }

    public function testDecreaseSellInByValueWhenAssertTrue(): void
    {
        $item = $this->setUpItem();
        $item->decreaseSellInBy(5);
        self::assertEquals(-5, $item->getSellIn());
    }

    public function testIncreaseQualityByValueWhenAssertTrue(): void
    {
        $item = $this->setUpItem();
        $item->increaseQualityBy(5);
        self::assertEquals(5, $item->getQuality());
    }

    public function testDecreaseQualityByValueWhenAssertTrue(): void
    {
        $item = $this->setUpItem();
        $item->decreaseQualityBy(5);
        self::assertEquals(-5, $item->getQuality());
    }
}
