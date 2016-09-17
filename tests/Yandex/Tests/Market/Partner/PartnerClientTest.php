<?php
/**
 * @namespace
 */
namespace Yandex\Tests\Market\Partner;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;
use Yandex\Market\Partner\Models\Item;
use Yandex\Market\Partner\Models\Order;
use Yandex\Market\Partner\PartnerClient;
use Yandex\Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: kuzmenko
 * Date: 11.08.16
 * Time: 15:45
 */
class PartnerClientTest extends TestCase
{
    protected $fixturesFolder = 'fixtures';

    function testGetCampaigns()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-campaigns.json');
        $campaignsJson = json_decode($json, true);

        $response = new Response(200, [], \GuzzleHttp\Psr7\stream_for($json));
        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['sendRequest']);
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        /** @var \Yandex\Market\Partner\Models\Campaigns $campaignsResp */
        $campaignsResp = $marketPartnerMock->getCampaigns()->getAll();
        foreach ($campaignsJson['campaigns'] as $k => $campaignJson) {
            $this->assertEquals($campaignJson['id'], $campaignsResp[$k]->getId());
            $this->assertEquals($campaignJson['domain'], $campaignsResp[$k]->getDomain());
            $this->assertEquals($campaignJson['state'], $campaignsResp[$k]->getState());
            if (isset($campaignJson['stateReasons'])) {
                foreach ($campaignJson['stateReasons'] as $key => $stateReason) {
                    $this->assertEquals($stateReason, $campaignsResp[$k]->getStateReasons()[$key]);
                }
            }
        }
    }

    function testGetOrders()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-orders.json');
        $ordersJson = json_decode($json);

        $response = new Response(200, [], \GuzzleHttp\Psr7\stream_for($json));
        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['sendRequest']);
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        /** @var \Yandex\Market\Partner\Models\Campaigns $campaignsResp */
        $campaignsResp = $marketPartnerMock->getOrders()->getAll();

        //order
        $order0 = $ordersJson->orders[0];
        $this->assertEquals($order0->id, $campaignsResp[0]->getId());
        $this->assertEquals($order0->creationDate, $campaignsResp[0]->getcreationDate());
        $this->assertEquals($order0->currency, $campaignsResp[0]->getCurrency());
        $this->assertEquals($order0->fake, $campaignsResp[0]->getFake());
        $this->assertEquals($order0->itemsTotal, $campaignsResp[0]->getItemsTotal());
        $this->assertEquals($order0->paymentType, $campaignsResp[0]->getPaymentType());
        $this->assertEquals($order0->paymentMethod, $campaignsResp[0]->getPaymentMethod());
        $this->assertEquals($order0->status, $campaignsResp[0]->getStatus());
        $this->assertEquals($order0->total, $campaignsResp[0]->getTotal());

        //buyer
        $buyer = $ordersJson->orders[0]->buyer;
        $this->assertEquals($buyer->id, $campaignsResp[0]->getBuyer()->getId());
        $this->assertEquals($buyer->lastName, $campaignsResp[0]->getBuyer()->getLastName());
        $this->assertEquals($buyer->firstName, $campaignsResp[0]->getBuyer()->getFirstName());
        $this->assertEquals($buyer->middleName, $campaignsResp[0]->getBuyer()->getMiddleName());
        $this->assertEquals($buyer->phone, $campaignsResp[0]->getBuyer()->getPhone());
        $this->assertEquals($buyer->email, $campaignsResp[0]->getBuyer()->getEmail());

        //delivery
        $delivery = $ordersJson->orders[0]->delivery;
        $this->assertEquals($delivery->type, $campaignsResp[0]->getDelivery()->getType());
        $this->assertEquals($delivery->serviceName, $campaignsResp[0]->getDelivery()->getServiceName());
        $this->assertEquals($delivery->price, $campaignsResp[0]->getDelivery()->getPrice());

        //delivery->address
        $deliveryAddress = $ordersJson->orders[0]->delivery->address;
        $this->assertEquals($deliveryAddress->country, $campaignsResp[0]->getDelivery()->getAddress()->getCountry());
        $this->assertEquals($deliveryAddress->postcode,  $campaignsResp[0]->getDelivery()->getAddress()->getPostcode());
        $this->assertEquals($deliveryAddress->city, $campaignsResp[0]->getDelivery()->getAddress()->getCity());
        $this->assertEquals($deliveryAddress->subway, $campaignsResp[0]->getDelivery()->getAddress()->getSubway());
        $this->assertEquals($deliveryAddress->street, $campaignsResp[0]->getDelivery()->getAddress()->getStreet());
        $this->assertEquals($deliveryAddress->house, $campaignsResp[0]->getDelivery()->getAddress()->getHouse());
        $this->assertEquals($deliveryAddress->entrance, $campaignsResp[0]->getDelivery()->getAddress()->getEntrance());
        $this->assertEquals($deliveryAddress->entryphone, $campaignsResp[0]->getDelivery()->getAddress()->getEntryphone());
        $this->assertEquals($deliveryAddress->floor, $campaignsResp[0]->getDelivery()->getAddress()->getFloor());
        $this->assertEquals($deliveryAddress->apartment, $campaignsResp[0]->getDelivery()->getAddress()->getApartment());
        $this->assertEquals($deliveryAddress->recipient, $campaignsResp[0]->getDelivery()->getAddress()->getRecipient());
        $this->assertEquals($deliveryAddress->phone, $campaignsResp[0]->getDelivery()->getAddress()->getPhone());

        //delivery->dates
        $deliveryDates = $ordersJson->orders[0]->delivery->dates;
        $this->assertEquals($deliveryDates->fromDate, $campaignsResp[0]->getDelivery()->getDates()->getFromDate());
        $this->assertEquals($deliveryDates->toDate, $campaignsResp[0]->getDelivery()->getDates()->getToDate());

        //delivery->region
        $deliveryRegion = $ordersJson->orders[0]->delivery->region;
        $this->assertEquals($deliveryRegion->id, $campaignsResp[0]->getDelivery()->getRegion()->getId());
        $this->assertEquals($deliveryRegion->name, $campaignsResp[0]->getDelivery()->getRegion()->getName());
        $this->assertEquals($deliveryRegion->type, $campaignsResp[0]->getDelivery()->getRegion()->getType());
        $this->assertEquals(
            $deliveryRegion->parent->id,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getId()
        );
        $this->assertEquals(
            $deliveryRegion->parent->name,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getName()
        );
        $this->assertEquals(
            $deliveryRegion->parent->type,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getType()
        );
        $this->assertEquals(
            $deliveryRegion->parent->parent->id,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getId()
        );
        $this->assertEquals(
            $deliveryRegion->parent->parent->name,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getName()
        );
        $this->assertEquals(
            $deliveryRegion->parent->parent->type,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getType()
        );
        $this->assertEquals(
            $deliveryRegion->parent->parent->parent->id,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getParent()->getId()
        );
        $this->assertEquals(
            $deliveryRegion->parent->parent->parent->name,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getParent()->getName()
        );
        $this->assertEquals(
            $deliveryRegion->parent->parent->parent->type,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getParent()->getType()
        );

        /** @var Item $item0 */
        $item0 = $campaignsResp[0]->getItems()->getAll()[0];
        $this->assertEquals($ordersJson->orders[0]->items[0]->feedId, $item0->getFeedId());
        $this->assertEquals($ordersJson->orders[0]->items[0]->offerId, $item0->getOfferId());
        $this->assertEquals($ordersJson->orders[0]->items[0]->feedCategoryId, $item0->getFeedCategoryId());
        $this->assertEquals($ordersJson->orders[0]->items[0]->offerName, $item0->getOfferName());
        $this->assertEquals($ordersJson->orders[0]->items[0]->price, $item0->getPrice());
        $this->assertEquals($ordersJson->orders[0]->items[0]->count, $item0->getCount());

        /** @var Item $item1 */
        $item1 = $campaignsResp[0]->getItems()->getAll()[1];
        $this->assertEquals($ordersJson->orders[0]->items[1]->feedId, $item1->getFeedId());
        $this->assertEquals($ordersJson->orders[0]->items[1]->offerId, $item1->getOfferId());
        $this->assertEquals($ordersJson->orders[0]->items[1]->feedCategoryId, $item1->getFeedCategoryId());
        $this->assertEquals($ordersJson->orders[0]->items[1]->offerName, $item1->getOfferName());
        $this->assertEquals($ordersJson->orders[0]->items[1]->price, $item1->getPrice());
        $this->assertEquals($ordersJson->orders[0]->items[1]->count, $item1->getCount());
    }

    public function testGetAccessToken()
    {
        $marketPartnerMock = $this->getMock(
            'Yandex\Market\Partner\PartnerClient',
            ['getClientId', 'getLogin'],
            ['testAccessToken']
        );

        $marketPartnerMock->expects($this->any())
            ->method('getClientId')
            ->will($this->returnValue(111));
        $marketPartnerMock->expects($this->any())
            ->method('getLogin')
            ->will($this->returnValue('testLogin'));

        $this->assertEquals(
            'oauth_token=testAccessToken, oauth_client_id=111, oauth_login=testLogin',
            $marketPartnerMock->getAccessToken()
        );
    }

    public function testGetPropertiesPartnerClient()
    {
        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['getAccessToken']);
        $marketPartnerMock->expects($this->any())
            ->method('getAccessToken')
            ->will($this->returnValue('oauth_token=testAccessToken, oauth_client_id=222, oauth_login=testLogin2'));
        $marketPartnerMock->setClientId(222);
        $marketPartnerMock->setLogin('testLogin2');
        $marketPartnerMock->setCampaignId(111);

        $this->assertEquals(222, $marketPartnerMock->getClientId());
        $this->assertEquals('testLogin2', $marketPartnerMock->getLogin());
        $this->assertEquals(111, $marketPartnerMock->getCampaignId());
    }

    public function testUpdateDelivery()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-order-for-update-delivery.json');
        $jsonObj = json_decode($json);
        $address = $jsonObj->order->delivery->address;

        $response = new Response(200, [], \GuzzleHttp\Psr7\stream_for($json));
        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['sendRequest']);
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        $deliveryMock = $this->getMock('Yandex\Market\Partner\Models\Delivery', ['getAddress']);
        $deliveryMock->expects($this->any())
            ->method('getAddress')
            ->will($this->returnValue($address));

        $updateDeliveryResp = $marketPartnerMock->updateDelivery(12345, $deliveryMock);
        
        //delivery->address
        $this->assertEquals($address->house, $updateDeliveryResp->getDelivery()->getAddress()->getHouse());
        $this->assertEquals($address->entrance, $updateDeliveryResp->getDelivery()->getAddress()->getEntrance());
        $this->assertEquals($address->entryphone, $updateDeliveryResp->getDelivery()->getAddress()->getEntryphone());
        $this->assertEquals($address->floor, $updateDeliveryResp->getDelivery()->getAddress()->getFloor());
        $this->assertEquals($address->apartment, $updateDeliveryResp->getDelivery()->getAddress()->getApartment());
        $this->assertEquals($address->recipient, $updateDeliveryResp->getDelivery()->getAddress()->getRecipient());
        $this->assertEquals($address->phone, $updateDeliveryResp->getDelivery()->getAddress()->getPhone());
    }

    public function testSetOrderStatus()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/set-order-status-response.json');
        $jsonObj = json_decode($json);
        $orderId = $jsonObj->order->id;

        $response = new Response(200, [], \GuzzleHttp\Psr7\stream_for($json));
        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['sendRequest']);
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        $orderStatusResp = $marketPartnerMock->setOrderStatus($orderId, 'CANCELLED', 'PROCESSING_EXPIRED');

        $this->assertEquals('CANCELLED', $orderStatusResp->getStatus());
        $this->assertEquals('PROCESSING_EXPIRED', $orderStatusResp->getSubStatus());
    }

    public  function testSendRequest()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-order-for-update-delivery.json');
        $response = new Response(200, [], \GuzzleHttp\Psr7\stream_for($json));
        $jsonObj = json_decode($json);
        $orderId = $jsonObj->order->id;

        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));

        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['getClient']);
        $marketPartnerMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $response = $marketPartnerMock->getOrder($orderId);
        $this->assertEquals($orderId, $response->getId());
    }

    public function testSendRequestForbiddenException()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-order-for-update-delivery.json');
        $jsonObj = json_decode($json);
        $orderId = $jsonObj->order->id;

        $response             = new Response(403);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));

        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['getClient']);
        $marketPartnerMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));
        $this->setExpectedException('Yandex\Common\Exception\ForbiddenException');

        $marketPartnerMock->getOrder($orderId);
    }

    function testSendRequestUnauthorizedException()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-order-for-update-delivery.json');
        $jsonObj = json_decode($json);
        $orderId = $jsonObj->order->id;

        $response             = new Response(401);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));

        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['getClient']);
        $marketPartnerMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));
        $this->setExpectedException('Yandex\Common\Exception\UnauthorizedException');

        $marketPartnerMock->getOrder($orderId);
    }

    public function testSendRequestPartnerRequestException()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-order-for-update-delivery.json');
        $jsonObj = json_decode($json);
        $orderId = $jsonObj->order->id;

        $response             = new Response(402);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));

        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['getClient']);
        $marketPartnerMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));
        $this->setExpectedException('Yandex\Market\Partner\Exception\PartnerRequestException');

        $marketPartnerMock->getOrder($orderId);
    }

    public function testSendRequestUnauthorizedExceptionWithTestMessage()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-order-for-update-delivery.json');
        $jsonObj = json_decode($json);
        $orderId = $jsonObj->order->id;

        $jsonStr = '{"error": {"message": "testUnauthorizedExceptionMessage"}}';

        $request              = new Request('GET', '');
        $response             = new Response(401, [], $jsonStr);
        $clientException      = new \GuzzleHttp\Exception\ClientException('', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($clientException));

        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['getClient']);
        $marketPartnerMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));
        $this->setExpectedException('Yandex\Common\Exception\UnauthorizedException', 'testUnauthorizedExceptionMessage');

        $marketPartnerMock->getOrder($orderId);
    }
}
