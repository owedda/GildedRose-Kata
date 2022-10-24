<?php

namespace GildedRose\GildedRose\Services;

use GildedRose\Models\Item;

interface AllCasesServiceInterface
{
    public function filterItem(Item $item): void;
}
