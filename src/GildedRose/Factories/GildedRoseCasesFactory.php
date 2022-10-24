<?php

declare(strict_types=1);

namespace GildedRose\GildedRose\Factories;

use GildedRose\GildedRose\Cases\AgedBrieCase;
use GildedRose\GildedRose\Cases\CaseInterface;
use GildedRose\GildedRose\Cases\OtherCases;
use GildedRose\GildedRose\Cases\TafkalCase;
use GildedRose\GildedRose\GildedRoseConstants;

class GildedRoseCasesFactory implements GildedRoseCasesFactoryInterface
{
    public function getGildedRoseCase(string $name): CaseInterface
    {
        return match ($name) {
            GildedRoseConstants::AGED_BRIE => new AgedBrieCase(),
            GildedRoseConstants::TAFKAL80ETC => new TafkalCase(),
            default => new OtherCases()
        };
    }
}
