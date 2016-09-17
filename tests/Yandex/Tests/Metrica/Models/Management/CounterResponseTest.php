<?php

namespace Yandex\Tests\Metrica\Models\Management;

use Yandex\Metrica\Management\Models;
use Yandex\Tests\TestCase;
use Yandex\Tests\Metrica\Fixtures\Counters;

class CounterResponseTest extends TestCase
{
    public function testAddCounterResponse()
    {
        $fixtures = Counters::$countersFixtures;
        $response = new Models\AddCounterResponse();
        $counter  = new Models\Counter($fixtures['counters'][0]);
        $response->setCounter($counter);
        $this->assertTrue($response->getCounter() instanceof Models\Counter);
    }

    public function testGetCounterResponse()
    {
        $fixtures = Counters::$countersFixtures;
        $response = new Models\GetCounterResponse();
        $counter  = new Models\Counter($fixtures['counters'][0]);
        $response->setCounter($counter);
        $this->assertTrue($response->getCounter() instanceof Models\Counter);
    }

    public function testGetCountersResponse()
    {
        $fixtures = Counters::$countersFixtures;
        $response = new Models\GetCountersResponse();
        $counters = new Models\Counters($fixtures['counters']);
        $response->setCounters($counters);
        $response->setRows($fixtures['rows']);
        $this->assertTrue($response->getCounters() instanceof Models\Counters);
        $this->assertEquals($fixtures['rows'], $response->getRows());
    }

    public function testUpdateCounterResponse()
    {
        $fixtures = Counters::$countersFixtures;
        $response = new Models\UpdateCounterResponse();
        $counter  = new Models\Counter($fixtures['counters'][0]);
        $response->setCounter($counter);
        $this->assertTrue($response->getCounter() instanceof Models\Counter);
    }
}
