<?php
/**
 * Yandex PHP Library
 *
 * @copyright NIX Solutions Ltd.
 * @link https://github.com/nixsolutions/yandex-php-library
 */

/**
 * @namespace
 */
namespace Yandex\Metrica;

use GuzzleHttp\ClientInterface;
use Yandex\Common\AbstractServiceClient;
use Psr\Http\Message\UriInterface;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
use Yandex\Common\Exception\ForbiddenException;
use Yandex\Common\Exception\UnauthorizedException;
use Yandex\Common\Exception\TooManyRequestsException;
use Yandex\Metrica\Exception\BadRequestException;
use Yandex\Metrica\Exception\MetricaException;

/**
 * Class MetricaClient
 *
 * @category Yandex
 * @package Metrica
 *
 * @author   Alexander Khaylo <naxel@land.ru>
 * @created  12.02.14 15:46
 */
class MetricaClient extends AbstractServiceClient
{
    /**
     * API domain
     *
     * @var string
     */
    protected $serviceDomain = 'api-metrika.yandex.ru/management/v1';

    /**
     * @param string $token access token
     * @param ClientInterface $client
     */
    public function __construct($token = '', ClientInterface $client = null)
    {
        $this->setAccessToken($token);
        if (!is_null($client)) {
            $this->setClient($client);
        }
    }

    /**
     * Get url to service resource with parameters
     *
     * @param string $resource
     * @param array $params
     * @see http://api.yandex.ru/metrika/doc/ref/concepts/method-call.xml
     * @return string
     */
    public function getServiceUrl($resource = '', $params = [])
    {
        $format = $resource === '' ? '' : '.json';
        $url = $this->serviceScheme . '://' . $this->serviceDomain . '/'
            . $resource . $format . '?oauth_token=' . $this->getAccessToken();

        if ($params) {
            $url .= '&' . http_build_query($params);
        }

        return $url;
    }

    /**
     * Sends a request
     *
     * @param string              $method  HTTP method
     * @param string|UriInterface $uri     URI object or string.
     * @param array               $options Request options to apply.
     *
     * @return Response
     *
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws MetricaException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     */
    protected function sendRequest($method, $uri, array $options = [])
    {
        try {
            $response = $this->getClient()->request($method, $uri, $options);
        } catch (ClientException $ex) {
            $result = $ex->getResponse();
            $code = $result->getStatusCode();
            $message = $result->getReasonPhrase();

            $body = $result->getBody();
            if ($body) {
                $jsonBody = json_decode($body);
                if ($jsonBody && isset($jsonBody->message)) {
                    $message = $jsonBody->message;
                }
            }

            if ($code === 400) {
                throw new BadRequestException($message);
            }

            if ($code === 403) {
                throw new ForbiddenException($message);
            }

            if ($code === 401) {
                throw new UnauthorizedException($message);
            }

            if ($code === 429) {
                throw new TooManyRequestsException($message);
            }

            throw new MetricaException(
                'Service responded with error code: "' . $code . '" and message: "' . $message . '"',
                $code
            );
        }

        return $response;
    }

    /**
     * Send GET request to API resource
     *
     * @param string $resource
     * @param array $params
     * @return array
     */
    protected function sendGetRequest($resource, $params = [])
    {
        $response = $this->sendRequest(
            'GET',
            $this->getServiceUrl($resource, $params),
            [
                'headers' => [
                    'Accept' => 'application/x-yametrika+json',
                    'Content-Type' => 'application/x-yametrika+json',
                ]
            ]
        );

        $decodedResponseBody = $this->getDecodedBody($response->getBody());

        if (isset($decodedResponseBody['links']) && isset($decodedResponseBody['links']['next'])) {
            $url = $decodedResponseBody['links']['next'];
            unset($decodedResponseBody['rows']);
            unset($decodedResponseBody['links']);
            return $this->getNextPartOfList($url, $decodedResponseBody);
        }
        return $decodedResponseBody;
    }

    /**
     * Send custom GET request to API resource
     *
     * @param string $url
     * @param array $data
     * @return array
     */
    protected function getNextPartOfList($url, $data = [])
    {
        $response = $this->sendRequest(
            'GET',
            $url,
            [
                'headers' => [
                    'Accept' => 'application/x-yametrika+json',
                    'Content-Type' => 'application/x-yametrika+json',
                ]
            ]
        );

        $decodedResponseBody = $this->getDecodedBody($response->getBody());

        $mergedDecodedResponseBody = array_merge_recursive($data, $decodedResponseBody);

        if (isset($mergedDecodedResponseBody['links']) && isset($mergedDecodedResponseBody['links']['next'])) {
            $url = $mergedDecodedResponseBody['links'];
            unset($mergedDecodedResponseBody['rows']);
            unset($mergedDecodedResponseBody['links']);
            return $this->getNextPartOfList($url, $response);
        }

        return $mergedDecodedResponseBody;
    }

    /**
     * Send POST request to API resource
     *
     * @param string $resource
     * @param array $params
     * @return array
     */
    protected function sendPostRequest($resource, $params)
    {
        $response = $this->sendRequest(
            'POST',
            $this->getServiceUrl($resource),
            [
                'headers' => [
                    'Accept' => 'application/x-yametrika+json',
                    'Content-Type' => 'application/x-yametrika+json',
                ],
                'json' => $params
            ]
        );

        return $this->getDecodedBody($response->getBody());
    }

    /**
     * Send PUT request to API resource
     *
     * @param string $resource
     * @param array $params
     * @return array
     */
    protected function sendPutRequest($resource, $params)
    {
        $response = $this->sendRequest(
            'PUT',
            $this->getServiceUrl($resource),
            [
                'headers' => [
                    'Accept' => 'application/x-yametrika+json',
                    'Content-Type' => 'application/x-yametrika+json',
                ],
                'json' => $params
            ]
        );

        return $this->getDecodedBody($response->getBody());
    }

    /**
     * Send DELETE request to API resource
     *
     * @param string $resource
     * @return array
     */
    protected function sendDeleteRequest($resource)
    {
        $response = $this->sendRequest(
            'DELETE',
            $this->getServiceUrl($resource),
            [
                'headers' => [
                    'Accept' => 'application/x-yametrika+json',
                    'Content-Type' => 'application/x-yametrika+json',
                ]
            ]
        );

        return $this->getDecodedBody($response->getBody());
    }
}
