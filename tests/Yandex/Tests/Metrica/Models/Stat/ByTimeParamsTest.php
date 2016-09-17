<?php
namespace Yandex\Tests\Metrica\Models\Stat;

use Yandex\Tests\Metrica\Fixtures\Stat;
use Yandex\Tests\TestCase;
use Yandex\Metrica\Stat\Models;

class ByTimeParamsTest extends TestCase
{

    public function testGet()
    {
        $fixtures = Stat::$byTimeParamsFixtures;

        $byTimeParams = new Models\ByTimeParams();
        $byTimeParams->setId($fixtures['id'])
            ->setPreset($fixtures['preset'])
            ->setDimensions($fixtures['dimensions'])
            ->setMetrics($fixtures['metrics'])
            ->setSort($fixtures['sort'])
            ->setLimit($fixtures['limit'])
            ->setOffset($fixtures['offset'])
            ->setDate1($fixtures['date1'])
            ->setDate2($fixtures['date2'])
            ->setFilters($fixtures['filters'])
            ->setAccuracy($fixtures['accuracy'])
            ->setCallback($fixtures['callback'])
            ->setIncludeUndefined($fixtures['include_undefined'])
            ->setLang($fixtures['lang'])
            ->setPretty($fixtures['pretty'])
            ->setGroup($fixtures['group'])
            ->setRowIds($fixtures['row_ids'])
            ->setTopKeys($fixtures['top_keys']);

        $this->assertEquals($fixtures['id'], $byTimeParams->getId());
        $this->assertEquals($fixtures['preset'], $byTimeParams->getPreset());
        $this->assertEquals($fixtures['dimensions'], $byTimeParams->getDimensions());
        $this->assertEquals($fixtures['metrics'], $byTimeParams->getMetrics());
        $this->assertEquals($fixtures['sort'], $byTimeParams->getSort());
        $this->assertEquals($fixtures['limit'], $byTimeParams->getLimit());
        $this->assertEquals($fixtures['offset'], $byTimeParams->getOffset());
        $this->assertEquals($fixtures['date1'], $byTimeParams->getDate1());
        $this->assertEquals($fixtures['date2'], $byTimeParams->getDate2());
        $this->assertEquals($fixtures['filters'], $byTimeParams->getFilters());
        $this->assertEquals($fixtures['accuracy'], $byTimeParams->getAccuracy());
        $this->assertEquals($fixtures['callback'], $byTimeParams->getCallback());
        $this->assertEquals($fixtures['include_undefined'], $byTimeParams->getIncludeUndefined());
        $this->assertEquals($fixtures['lang'], $byTimeParams->getLang());
        $this->assertEquals($fixtures['pretty'], $byTimeParams->getPretty());
        $this->assertEquals($fixtures['group'], $byTimeParams->getGroup());
        $this->assertEquals($fixtures['row_ids'], $byTimeParams->getRowIds());
        $this->assertEquals($fixtures['top_keys'], $byTimeParams->getTopKeys());
    }
}
