<?php

declare(strict_types=1);

namespace GildedRose\Models;

final class Item
{
    public function __construct(private string $name, private int $sell_in, private int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getQuality(): int
    {
        return $this->quality;
    }

    /**
     * @return int
     */
    public function getSellIn(): int
    {
        return $this->sell_in;
    }

    /**
     * @param int $quality
     */
    public function setQuality(int $quality): void
    {
        $this->quality = $quality;
    }

    public function increaseQualityBy(int $value): void
    {
        $this->quality += $value;
    }

    public function decreaseQualityBy(int $value): void
    {
        $this->quality -= $value;
    }

    public function decreaseSellInBy(int $value): void
    {
        $this->sell_in -= $value;
    }
}
