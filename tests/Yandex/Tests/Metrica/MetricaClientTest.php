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
namespace Yandex\Tests\Dictionary;

use Yandex\Dictionary\DictionaryClient;
use Yandex\Metrica\MetricaClient;
use Yandex\Tests\Metrica\Fixtures\Accounts;
use Yandex\Tests\TestCase;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use Yandex\Metrica\Management\AccountsClient;

/**
 * PackageTest
 *
 * @category Yandex
 * @package  Tests
 *
 * @author   Alex Khaylo
 * @created  17.03.16 15:43
 */
class MetricaClientTest extends TestCase
{
    protected $fixturesFolder = 'fixtures';

    public function testConstruct()
    {
        $token         = 'test';
        $metricaClient = new MetricaClient($token);
        $this->assertEquals($token, $metricaClient->getAccessToken());
    }

    public function testConstructWithCustomGuzzleClient()
    {
        $token = 'test';
        $metricaClient = new MetricaClient($token, $this->getMock('GuzzleHttp\Client'));
        $this->assertEquals($token, $metricaClient->getAccessToken());
    }

    function testSendRequestForbiddenException()
    {
        $token                = 'test';
        $response             = new Response(403);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var AccountsClient $accountsClientMock */
        $accountsClientMock = $this->getMock('Yandex\Metrica\Management\AccountsClient', ['getClient'], [$token]);
        $accountsClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\ForbiddenException');
        $accountsClientMock->getAccounts();
    }

    function testSendRequestUnauthorizedException()
    {
        $token                = 'test';
        $response             = new Response(401);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var AccountsClient $accountsClientMock */
        $accountsClientMock = $this->getMock('Yandex\Metrica\Management\AccountsClient', ['getClient'], [$token]);
        $accountsClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\UnauthorizedException');
        $accountsClientMock->getAccounts();
    }

    function testSendRequestBadRequestException()
    {
        $fixtures             = Accounts::$badRequestFixtures;
        $token                = 'test';
        $response             = new Response(400, [], \GuzzleHttp\Psr7\stream_for(json_encode($fixtures)));
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var AccountsClient $accountsClientMock */
        $accountsClientMock = $this->getMock('Yandex\Metrica\Management\AccountsClient', ['getClient'], [$token]);
        $accountsClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Metrica\Exception\BadRequestException');
        $accountsClientMock->getAccounts();
    }

    function testSendRequestTooManyRequestsException()
    {
        $token                = 'test';
        $response             = new Response(429);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var AccountsClient $accountsClientMock */
        $accountsClientMock = $this->getMock('Yandex\Metrica\Management\AccountsClient', ['getClient'], [$token]);
        $accountsClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\TooManyRequestsException');
        $accountsClientMock->getAccounts();
    }

    function testSendRequestMetricaException()
    {
        $token                = 'test';
        $response             = new Response(500);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var AccountsClient $accountsClientMock */
        $accountsClientMock = $this->getMock('Yandex\Metrica\Management\AccountsClient', ['getClient'], [$token]);
        $accountsClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Metrica\Exception\MetricaException');
        $accountsClientMock->getAccounts();
    }

    function testSendRequestResponse()
    {
        $fixtures             = Accounts::$accountsFixtures;
        $token                = 'test';
        $response             = new Response(200, [], \GuzzleHttp\Psr7\stream_for(json_encode($fixtures)));
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));
        /** @var AccountsClient $accountsClientMock */
        $accountsClientMock = $this->getMock('Yandex\Metrica\Management\AccountsClient', ['getClient'], [$token]);
        $accountsClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));
        $table = $accountsClientMock->getAccounts();
        $this->assertEquals($fixtures["accounts"][0]["user_login"], $table->current()->getUserLogin());
        $this->assertEquals($fixtures["accounts"][0]["created_at"], $table->current()->getCreatedAt());
    }

    public function testGetServiceUrl()
    {
        $metricaClient = new MetricaClient();
        $this->assertNotEmpty($metricaClient->getServiceUrl('test', ['test' => 'test']));
    }
}
