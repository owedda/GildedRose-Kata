<?php

declare(strict_types=1);

namespace GildedRose\GildedRose;

use GildedRose\GildedRose\Services\AllCasesServiceInterface;

final class GildedRose
{
    public function __construct(
        private readonly AllCasesServiceInterface $allCases,
        private readonly array $items
    ) {
    }

    public function updateItemsByNames(): void
    {
        foreach ($this->items as $item) {
            $this->allCases->filterItem($item);
        }
    }
}
