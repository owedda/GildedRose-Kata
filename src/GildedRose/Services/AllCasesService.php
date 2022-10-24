<?php

declare(strict_types=1);

namespace GildedRose\GildedRose\Services;

use GildedRose\GildedRose\Cases\CaseInterface;
use GildedRose\GildedRose\Factories\GildedRoseCasesFactoryInterface;
use GildedRose\GildedRose\GildedRoseConstants;
use GildedRose\Models\Item;

class AllCasesService implements AllCasesServiceInterface
{
    public function __construct(private readonly GildedRoseCasesFactoryInterface $casesFactory)
    {
    }

    public function filterItem(Item $item): void
    {
        if ($item->getName() === GildedRoseConstants::SULFURAS) {
            return;
        }
        $case = $this->getFilteredCase($item);
        $case->updateQualityByRules($item);
        $item->decreaseSellInBy(1);
    }

    private function getFilteredCase(Item $item): CaseInterface
    {
        return $this->casesFactory->getGildedRoseCase($item->getName());
    }
}
