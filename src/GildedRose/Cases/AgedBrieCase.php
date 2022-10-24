<?php

declare(strict_types=1);

namespace GildedRose\GildedRose\Cases;

use GildedRose\Models\Item;

class AgedBrieCase implements CaseInterface
{
    public function updateQualityByRules(Item $item): void
    {
        if ($item->getSellIn() > 0 && $item->getQuality() < 49) {
            $item->increaseQualityBy(1);
            return;
        }

        if ($item->getSellIn() < 1 && $item->getQuality() < 49) {
            $item->increaseQualityBy(2);
            return;
        }

        if ($item->getSellIn() < 1 && $item->getQuality() < 50) {
            $item->increaseQualityBy(1);
        }
    }
}
