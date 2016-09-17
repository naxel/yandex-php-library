<?php
/**
 * Yandex PHP Library
 *
 * @copyright NIX Solutions Ltd.
 * @link      https://github.com/nixsolutions/yandex-php-library
 */
/**
 * @namespace
 */
namespace Yandex\Tests\Metrica;

use Yandex\Metrica\Stat\DataClient;
use Yandex\Metrica\Stat\StatClient;
use Yandex\Tests\TestCase;

/**
 * PackageTest
 *
 * @category Yandex
 * @package  Tests
 *
 * @author   Alex Khaylo
 * @created  18.03.16 16:58
 */
class StatClientTest extends TestCase
{
    public function testGetCountersClient()
    {
        $token      = 'test';
        $statClient = new StatClient($token);
        $client     = $statClient->data();
        $this->assertTrue($client instanceof DataClient);
        $this->assertEquals($token, $client->getAccessToken());
    }

    /**
     * @covers \Yandex\Metrica\Stat\StatClient::data
     */
    public function testMethodDataWithCustomClient()
    {
        $token      = 'test';
        $statClient = new StatClient($token, $this->getMock('GuzzleHttp\Client'));
        $client     = $statClient->data();
        $this->assertTrue($client instanceof DataClient);
        $this->assertEquals($token, $client->getAccessToken());
    }
}
