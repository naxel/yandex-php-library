<?php
namespace Yandex\Tests\Metrica\Models\Stat;

use Yandex\Tests\Metrica\Fixtures\Stat;
use Yandex\Tests\TestCase;
use Yandex\Metrica\Stat\Models;

/**
 * Class TableParamsTest
 * @package Yandex\Tests\Metrica\Models\Stat
 */
class TableParamsTest extends TestCase
{

    public function testGet()
    {
        $fixtures = Stat::$tableParamsFixtures;

        $comparisonParams = new Models\TableParams();
        $comparisonParams->setId($fixtures['id'])
            ->setPreset($fixtures['preset'])
            ->setDimensions($fixtures['dimensions'])
            ->setMetrics($fixtures['metrics'])
            ->setSort($fixtures['sort'])
            ->setLimit($fixtures['limit'])
            ->setOffset($fixtures['offset'])
            ->setFilters($fixtures['filters'])
            ->setDate1($fixtures['date1'])
            ->setDate2($fixtures['date2'])
            ->setFilters($fixtures['filters'])
            ->setAccuracy($fixtures['accuracy'])
            ->setCallback($fixtures['callback'])
            ->setIncludeUndefined($fixtures['include_undefined'])
            ->setLang($fixtures['lang'])
            ->setPretty($fixtures['pretty']);

        $this->assertEquals($fixtures['id'], $comparisonParams->getId());
        $this->assertEquals($fixtures['preset'], $comparisonParams->getPreset());
        $this->assertEquals($fixtures['dimensions'], $comparisonParams->getDimensions());
        $this->assertEquals($fixtures['metrics'], $comparisonParams->getMetrics());
        $this->assertEquals($fixtures['sort'], $comparisonParams->getSort());
        $this->assertEquals($fixtures['limit'], $comparisonParams->getLimit());
        $this->assertEquals($fixtures['offset'], $comparisonParams->getOffset());
        $this->assertEquals($fixtures['filters'], $comparisonParams->getFilters());
        $this->assertEquals($fixtures['date1'], $comparisonParams->getDate1());
        $this->assertEquals($fixtures['date2'], $comparisonParams->getDate2());
        $this->assertEquals($fixtures['filters'], $comparisonParams->getFilters());
        $this->assertEquals($fixtures['accuracy'], $comparisonParams->getAccuracy());
        $this->assertEquals($fixtures['callback'], $comparisonParams->getCallback());
        $this->assertEquals($fixtures['include_undefined'], $comparisonParams->getIncludeUndefined());
        $this->assertEquals($fixtures['lang'], $comparisonParams->getLang());
        $this->assertEquals($fixtures['pretty'], $comparisonParams->getPretty());
    }
}
