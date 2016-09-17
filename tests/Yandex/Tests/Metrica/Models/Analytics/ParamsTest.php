<?php
namespace Yandex\Tests\Metrica\Models\Analytics;

use Yandex\Tests\Metrica\Fixtures\Analytics;
use Yandex\Tests\TestCase;
use Yandex\Metrica\Analytics\Models;

/**
 * Class ParamsTest
 * @package Yandex\Tests\Metrica\Models\Stat
 */
class ParamsTest extends TestCase
{
    public function testGet()
    {
        $fixtures         = Analytics::$paramsFixtures;
        $comparisonParams = new Models\Params();
        $comparisonParams->setIds($fixtures['ids'])
            ->setStartDate($fixtures['start-date'])
            ->setEndDate($fixtures['end-date'])
            ->setDimensions($fixtures['dimensions'])
            ->setMetrics($fixtures['metrics'])
            ->setSort($fixtures['sort'])
            ->setFilters($fixtures['filters'])
            ->setCallback($fixtures['callback'])
            ->setMaxResults($fixtures['max-results'])
            ->setStartIndex($fixtures['start-index'])
            ->setSamplingLevel($fixtures['samplingLevel']);

        $this->assertEquals($fixtures['ids'], $comparisonParams->getIds());
        $this->assertEquals($fixtures['start-date'], $comparisonParams->getStartDate());
        $this->assertEquals($fixtures['end-date'], $comparisonParams->getEndDate());
        $this->assertEquals($fixtures['dimensions'], $comparisonParams->getDimensions());
        $this->assertEquals($fixtures['metrics'], $comparisonParams->getMetrics());
        $this->assertEquals($fixtures['sort'], $comparisonParams->getSort());
        $this->assertEquals($fixtures['filters'], $comparisonParams->getFilters());
        $this->assertEquals($fixtures['callback'], $comparisonParams->getCallback());
        $this->assertEquals($fixtures['max-results'], $comparisonParams->getMaxResults());
        $this->assertEquals($fixtures['start-index'], $comparisonParams->getStartIndex());
        $this->assertEquals($fixtures['samplingLevel'], $comparisonParams->getSamplingLevel());
    }
}
