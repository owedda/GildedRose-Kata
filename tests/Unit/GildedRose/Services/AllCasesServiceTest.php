<?php

declare(strict_types=1);

namespace Tests\Unit\GildedRose\Services;

use GildedRose\GildedRose\Cases\CaseInterface;
use GildedRose\GildedRose\Factories\GildedRoseCasesFactoryInterface;
use GildedRose\GildedRose\GildedRoseConstants;
use GildedRose\GildedRose\Services\AllCasesService;
use GildedRose\Models\Item;
use PHPUnit\Framework\TestCase;

class AllCasesServiceTest extends TestCase
{
    public function testFilterItemDecreasesSellInValueByOneEqualsTrue(): void
    {
        $item = new Item('TEST', 1, 1);
        $itemExpected = new Item('TEST', 0, 1);

        $mockedCasesFactory = $this->getMockBuilder(GildedRoseCasesFactoryInterface::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getGildedRoseCase'])
            ->getMock();

        $service = new AllCasesService($mockedCasesFactory);
        $service->filterItem($item);

        $this->assertEquals($itemExpected, $item);
    }

    public function testFilterItemWhenNameIsSulfurasDoesNothingEqualsTrue(): void
    {
        $item = new Item(GildedRoseConstants::SULFURAS, 1, 1);
        $itemExpected = new Item(GildedRoseConstants::SULFURAS, 1, 1);

        $mockedCasesFactory = $this->getMockBuilder(GildedRoseCasesFactoryInterface::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getGildedRoseCase'])
            ->getMock();

        $service = new AllCasesService($mockedCasesFactory);
        $service->filterItem($item);

        $this->assertEquals($itemExpected, $item);
    }

    public function testFilterItemCallsMethodUpdateQualityByRulesEqualsTrue(): void
    {
        $item = new Item("TEST", 1, 1);

        $mockUnderTest = $this->getMockBuilder(CaseInterface::class)
            ->onlyMethods(['updateQualityByRules'])
            ->getMock();
        $mockUnderTest->expects($this->exactly(1))
            ->method('updateQualityByRules')
            ->willReturnOnConsecutiveCalls(
                $item
            );

        $mockedCasesFactory = $this->getMockBuilder(GildedRoseCasesFactoryInterface::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getGildedRoseCase'])
            ->getMock();

        $mockedCasesFactory->method('getGildedRoseCase')->willReturn($mockUnderTest);

        $service = new AllCasesService($mockedCasesFactory);
        $service->filterItem($item);
    }

    public function testFilterItemDoesntCallMethodUpdateQualityByRulesWhenNameIsSulfurasEqualsTrue(): void
    {
        $item = new Item(GildedRoseConstants::SULFURAS, 1, 1);

        $mockUnderTest = $this->getMockBuilder(CaseInterface::class)
            ->onlyMethods(['updateQualityByRules'])
            ->getMock();
        $mockUnderTest->expects($this->exactly(0))
            ->method('updateQualityByRules')
            ->willReturnOnConsecutiveCalls(
                $item
            );

        $mockedCasesFactory = $this->getMockBuilder(GildedRoseCasesFactoryInterface::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getGildedRoseCase'])
            ->getMock();

        $mockedCasesFactory->method('getGildedRoseCase')->willReturn($mockUnderTest);

        $service = new AllCasesService($mockedCasesFactory);
        $service->filterItem($item);
    }
}
