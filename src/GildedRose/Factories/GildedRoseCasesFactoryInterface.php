<?php

declare(strict_types=1);

namespace GildedRose\GildedRose\Factories;

use GildedRose\GildedRose\Cases\CaseInterface;

interface GildedRoseCasesFactoryInterface
{
    public function getGildedRoseCase(string $name): CaseInterface;
}
