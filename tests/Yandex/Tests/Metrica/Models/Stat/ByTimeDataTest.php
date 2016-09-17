<?php
namespace Yandex\Tests\Metrica\Models\Stat;

use Yandex\Tests\Metrica\Fixtures\Stat;
use Yandex\Tests\TestCase;
use Yandex\Metrica\Stat\Models;

class ByTimeDataTest extends TestCase
{

    public function testGet()
    {
        $fixtures = Stat::$byTimeFixtures;

        $query = new Models\Query();
        $query
            ->setId($fixtures['query']['id'])
            ->setDimensions($fixtures['query']['dimensions'])
            ->setMetrics($fixtures['query']['metrics'])
            ->setSort($fixtures['query']['sort'])
            ->setDate1($fixtures['query']['date1'])
            ->setDate2($fixtures['query']['date2']);

        $items = new Models\Items();
        $items
            ->setDimensions($fixtures['data'][0]['dimensions'])
            ->setMetrics($fixtures['data'][0]['metrics']);

        $data = new Models\Data();
        $data->add($items);

        $byTime = new Models\ByTimeData();
        $byTime->setQuery($query)
            ->setData($data)
            ->setTotalRows($fixtures['total_rows'])
            ->setSampled($fixtures['sampled'])
            ->setSampleShare($fixtures['sample_share'])
            ->setSampleSize($fixtures['sample_size'])
            ->setSampleSpace($fixtures['sample_space'])
            ->setDataLag($fixtures['data_lag'])
            ->setTotals($fixtures['totals']);

        $this->assertEquals($fixtures["query"]["id"], $byTime->getQuery()->getId());
        $this->assertEquals($fixtures["query"]["dimensions"], $byTime->getQuery()->getDimensions());
        $this->assertEquals($fixtures["query"]["metrics"], $byTime->getQuery()->getMetrics());
        $this->assertEquals($fixtures["query"]["sort"], $byTime->getQuery()->getSort());
        $this->assertEquals($fixtures["query"]["date1"], $byTime->getQuery()->getDate1());
        $this->assertEquals($fixtures["query"]["date2"], $byTime->getQuery()->getDate2());

        $getData = $byTime->getData()->getAll();

        $this->assertEquals($fixtures["data"][0]["dimensions"], $getData[0]->getDimensions());
        $this->assertEquals($fixtures["data"][0]["metrics"], $getData[0]->getMetrics());

        $this->assertEquals($fixtures["total_rows"], $byTime->getTotalRows());
        $this->assertEquals($fixtures["sampled"], $byTime->getSampled());
        $this->assertEquals($fixtures["sample_share"], $byTime->getSampleShare());
        $this->assertEquals($fixtures["sample_size"], $byTime->getSampleSize());
        $this->assertEquals($fixtures["sample_space"], $byTime->getSampleSpace());
        $this->assertEquals($fixtures["data_lag"], $byTime->getDataLag());
        $this->assertEquals($fixtures["totals"], $byTime->getTotals());
    }

    public function testGetWithGroup()
    {
        $fixtures = Stat::$byTimeWithGroupFixtures;

        $query = new Models\Query();
        $query
            ->setId($fixtures['query']['id'])
            ->setDimensions($fixtures['query']['dimensions'])
            ->setMetrics($fixtures['query']['metrics'])
            ->setSort($fixtures['query']['sort'])
            ->setDate1($fixtures['query']['date1'])
            ->setDate2($fixtures['query']['date2'])
            ->setGroup($fixtures['query']['group'])
            ->setAutoGroupType($fixtures['query']['auto_group_type'])
            ->setAutoGroupSize($fixtures['query']['auto_group_size']);

        $items = new Models\Items();
        $items
            ->setDimensions($fixtures['data'][0]['dimensions'])
            ->setMetrics($fixtures['data'][0]['metrics']);

        $data = new Models\Data();
        $data->add($items);

        $byTime = new Models\ByTimeData();
        $byTime->setQuery($query)
            ->setData($data)
            ->setTotalRows($fixtures['total_rows'])
            ->setSampled($fixtures['sampled'])
            ->setSampleShare($fixtures['sample_share'])
            ->setSampleSize($fixtures['sample_size'])
            ->setSampleSpace($fixtures['sample_space'])
            ->setDataLag($fixtures['data_lag'])
            ->setTotals($fixtures['totals']);

        $this->assertEquals($fixtures["query"]["id"], $byTime->getQuery()->getId());
        $this->assertEquals($fixtures["query"]["dimensions"], $byTime->getQuery()->getDimensions());
        $this->assertEquals($fixtures["query"]["metrics"], $byTime->getQuery()->getMetrics());
        $this->assertEquals($fixtures["query"]["sort"], $byTime->getQuery()->getSort());
        $this->assertEquals($fixtures["query"]["date1"], $byTime->getQuery()->getDate1());
        $this->assertEquals($fixtures["query"]["date2"], $byTime->getQuery()->getDate2());
        $this->assertEquals($fixtures["query"]["group"], $byTime->getQuery()->getGroup());
        $this->assertEquals($fixtures["query"]["auto_group_type"], $byTime->getQuery()->getAutoGroupType());
        $this->assertEquals($fixtures["query"]["auto_group_size"], $byTime->getQuery()->getAutoGroupSize());

        $getData = $byTime->getData()->getAll();

        $this->assertEquals($fixtures["data"][0]["dimensions"], $getData[0]->getDimensions());
        $this->assertEquals($fixtures["data"][0]["metrics"], $getData[0]->getMetrics());

        $this->assertEquals($fixtures["total_rows"], $byTime->getTotalRows());
        $this->assertEquals($fixtures["sampled"], $byTime->getSampled());
        $this->assertEquals($fixtures["sample_share"], $byTime->getSampleShare());
        $this->assertEquals($fixtures["sample_size"], $byTime->getSampleSize());
        $this->assertEquals($fixtures["sample_space"], $byTime->getSampleSpace());
        $this->assertEquals($fixtures["data_lag"], $byTime->getDataLag());
        $this->assertEquals($fixtures["totals"], $byTime->getTotals());
    }

    public function testGetWithGroupByDays()
    {
        $fixtures = Stat::$byTimeWithGroupByDaysFixtures;

        $query = new Models\Query();
        $query
            ->setIds($fixtures['query']['ids'])
            ->setDimensions($fixtures['query']['dimensions'])
            ->setMetrics($fixtures['query']['metrics'])
            ->setSort($fixtures['query']['sort'])
            ->setDate1($fixtures['query']['date1'])
            ->setDate2($fixtures['query']['date2'])
            ->setGroup($fixtures['query']['group'])
            ->setFilters($fixtures['query']['filters'])
            ->setAutoGroupType($fixtures['query']['auto_group_type'])
            ->setAutoGroupSize($fixtures['query']['auto_group_size']);

        $items = new Models\Items();
        $items
            ->setDimensions($fixtures['data'][0]['dimensions'])
            ->setMetrics($fixtures['data'][0]['metrics']);

        $data = new Models\Data();
        $data->add($items);

        $byTime = new Models\ByTimeData();
        $byTime->setQuery($query)
            ->setData($data)
            ->setTotalRows($fixtures['total_rows'])
            ->setSampled($fixtures['sampled'])
            ->setSampleShare($fixtures['sample_share'])
            ->setSampleSize($fixtures['sample_size'])
            ->setSampleSpace($fixtures['sample_space'])
            ->setDataLag($fixtures['data_lag'])
            ->setTotals($fixtures['totals']);

        $this->assertEquals($fixtures["query"]["ids"], $byTime->getQuery()->getIds());
        $this->assertEquals($fixtures["query"]["dimensions"], $byTime->getQuery()->getDimensions());
        $this->assertEquals($fixtures["query"]["metrics"], $byTime->getQuery()->getMetrics());
        $this->assertEquals($fixtures["query"]["sort"], $byTime->getQuery()->getSort());
        $this->assertEquals($fixtures["query"]["date1"], $byTime->getQuery()->getDate1());
        $this->assertEquals($fixtures["query"]["date2"], $byTime->getQuery()->getDate2());
        $this->assertEquals($fixtures["query"]["filters"], $byTime->getQuery()->getFilters());
        $this->assertEquals($fixtures["query"]["group"], $byTime->getQuery()->getGroup());
        $this->assertEquals($fixtures["query"]["auto_group_type"], $byTime->getQuery()->getAutoGroupType());
        $this->assertEquals($fixtures["query"]["auto_group_size"], $byTime->getQuery()->getAutoGroupSize());

        $getData = $byTime->getData()->getAll();

        $this->assertEquals($fixtures["data"][0]["dimensions"], $getData[0]->getDimensions());
        $this->assertEquals($fixtures["data"][0]["metrics"], $getData[0]->getMetrics());

        $this->assertEquals($fixtures["total_rows"], $byTime->getTotalRows());
        $this->assertEquals($fixtures["sampled"], $byTime->getSampled());
        $this->assertEquals($fixtures["sample_share"], $byTime->getSampleShare());
        $this->assertEquals($fixtures["sample_size"], $byTime->getSampleSize());
        $this->assertEquals($fixtures["sample_space"], $byTime->getSampleSpace());
        $this->assertEquals($fixtures["data_lag"], $byTime->getDataLag());
        $this->assertEquals($fixtures["totals"], $byTime->getTotals());
    }
}
 