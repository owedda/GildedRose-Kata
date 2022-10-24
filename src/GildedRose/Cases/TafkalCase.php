<?php

declare(strict_types=1);

namespace GildedRose\GildedRose\Cases;

use GildedRose\Models\Item;

class TafkalCase implements CaseInterface
{
    public function updateQualityByRules(Item $item): void
    {
        if ($item->getSellIn() < 1 && $item->getQuality() < 50) {
            $item->setQuality(0);
            return;
        }

        if ($item->getSellIn() < 6 && $item->getQuality() < 48) {
            $item->increaseQualityBy(3);
            return;
        }

        if ($item->getSellIn() < 11 && $item->getQuality() < 49) {
            $item->increaseQualityBy(2);
            return;
        }

        if ($item->getSellIn() > 11 && $item->getQuality() < 50) {
            $item->increaseQualityBy(1);
        }
    }
}
