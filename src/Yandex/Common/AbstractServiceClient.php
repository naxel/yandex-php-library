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
namespace Yandex\Common;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\UriInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Yandex\Common\Exception\MissedArgumentException;
use Yandex\Common\Exception\ProfileNotFoundException;
use Yandex\Common\Exception\YandexException;

/**
 * Class AbstractServiceClient
 *
 * @package Yandex\Common
 *
 * @author   Eugene Zabolotniy <realbaziak@gmail.com>
 * @created  13.09.13 12:09
 */
abstract class AbstractServiceClient extends AbstractPackage
{
    /**
     * Request schemes constants
     */
    const HTTPS_SCHEME = 'https';
    const HTTP_SCHEME = 'http';

    const DECODE_TYPE_JSON = 'json';
    const DECODE_TYPE_XML = 'xml';
    const DECODE_TYPE_DEFAULT = self::DECODE_TYPE_JSON;

    /**
     * @var string
     */
    protected $serviceScheme = self::HTTPS_SCHEME;

    /**
     * Can be HTTP 1.0 or HTTP 1.1
     * @var string
     */
    protected $serviceProtocolVersion = '1.1';

    /**
     * @var string
     */
    protected $serviceDomain = '';

    /**
     * @var string
     */
    protected $servicePort = '';

    /**
     * @var string
     */
    protected $accessToken = '';


    /**
     * @var \DateTime
     */
    protected $expiresIn = null;

    /**
     * @var string
     */
    protected $proxy = '';

    /**
     * @var bool
     */
    protected $debug = false;

    /**
     * @var null
     */
    protected $client = null;

    /**
     * @var string
     */
    protected $libraryName = 'yandex-php-library';

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->libraryName . '/' . Version::$version;
    }

    /**
     * @param string $accessToken
     *
     * @return self
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param \DateTime $expiresIn
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
    }

    /**
     * @return mixed
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param $proxy
     * @return $this
     */
    public function setProxy($proxy)
    {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * @return string
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    /**
     * @param $debug
     * @return $this
     */
    public function setDebug($debug)
    {
        $this->debug = (bool) $debug;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * @param string $serviceDomain
     *
     * @return self
     */
    public function setServiceDomain($serviceDomain)
    {
        $this->serviceDomain = $serviceDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceDomain()
    {
        return $this->serviceDomain;
    }

    /**
     * @param string $servicePort
     *
     * @return self
     */
    public function setServicePort($servicePort)
    {
        $this->servicePort = $servicePort;

        return $this;
    }

    /**
     * @return string
     */
    public function getServicePort()
    {
        return $this->servicePort;
    }

    /**
     * @param string $serviceScheme
     *
     * @return self
     */
    public function setServiceScheme($serviceScheme = self::HTTPS_SCHEME)
    {
        $this->serviceScheme = $serviceScheme;

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceScheme()
    {
        return $this->serviceScheme;
    }

    /**
     * @param string $resource
     * @return string
     */
    public function getServiceUrl($resource = '')
    {
        return $this->serviceScheme . '://' . $this->serviceDomain . '/' . rawurlencode($resource);
    }

    /**
     * Check package configuration
     *
     * @return boolean
     */
    protected function doCheckSettings()
    {
        return true;
    }

    /**
     * @param ClientInterface $client
     * @return $this
     */
    protected function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return ClientInterface
     */
    protected function getClient()
    {
        if (is_null($this->client)) {
            $defaultOptions = [
                'base_uri' => $this->getServiceUrl(),
                'headers' => [
                    'Authorization' => 'OAuth ' . $this->getAccessToken(),
                    'Host' => $this->getServiceDomain(),
                    'User-Agent' => $this->getUserAgent(),
                    'Accept' => '*/*'
                ]
            ];
            if ($this->getProxy()) {
                $defaultOptions['proxy'] = $this->getProxy();
            }
            if ($this->getDebug()) {
                $defaultOptions['debug'] = $this->getDebug();
            }
            $this->client = new Client($defaultOptions);
        }

        return $this->client;
    }

    /**
     * Sends a request
     *
     * @param string              $method  HTTP method
     * @param string|UriInterface $uri     URI object or string.
     * @param array               $options Request options to apply.
     *
     * @throws Exception\MissedArgumentException
     * @throws Exception\ProfileNotFoundException
     * @throws Exception\YandexException
     * @return Response
     */
    protected function sendRequest($method, $uri, array $options = [])
    {
        try {
            $response = $this->getClient()->request($method, $uri, $options);
        } catch (ClientException $ex) {
            // get error from response
            $decodedResponseBody = $this->getDecodedBody($ex->getResponse()->getBody());
            $code = $ex->getResponse()->getStatusCode();

            // handle a service error message
            if (is_array($decodedResponseBody)
                && isset($decodedResponseBody['error'], $decodedResponseBody['message'])
            ) {
                switch ($decodedResponseBody['error']) {
                    case 'MissedRequiredArguments':
                        throw new MissedArgumentException($decodedResponseBody['message']);
                    case 'AssistantProfileNotFound':
                        throw new ProfileNotFoundException($decodedResponseBody['message']);
                    default:
                        throw new YandexException($decodedResponseBody['message'], $code);
                }
            }

            // unknown error
            throw $ex;
        }

        return $response;
    }

    /**
     * @param $body
     * @param string $type
     * @return mixed|\SimpleXMLElement
     */
    protected function getDecodedBody($body, $type = null)
    {
        if (!isset($type)) {
            $type = static::DECODE_TYPE_DEFAULT;
        }
        switch ($type) {
            case self::DECODE_TYPE_XML:
                return simplexml_load_string((string) $body);
            case self::DECODE_TYPE_JSON:
            default:
                return json_decode((string) $body, true);
        }
    }
}
