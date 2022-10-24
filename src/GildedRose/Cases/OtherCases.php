<?php

declare(strict_types=1);

namespace GildedRose\GildedRose\Cases;

use GildedRose\Models\Item;

class OtherCases implements CaseInterface
{
    public function updateQualityByRules(Item $item): void
    {
        if ($item->getSellIn() < 1 && $item->getQuality() > 1) {
            $item->decreaseQualityBy(2);
            return;
        }

        if ($item->getQuality() > 0) {
            $item->decreaseQualityBy(1);
        }
    }
}
