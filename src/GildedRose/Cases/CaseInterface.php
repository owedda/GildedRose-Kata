<?php

declare(strict_types=1);

namespace GildedRose\GildedRose\Cases;

use GildedRose\Models\Item;

interface CaseInterface
{
    public function updateQualityByRules(Item $item): void;
}
