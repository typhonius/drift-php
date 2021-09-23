<?php

namespace Drift\Client;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\RequestInterface;
use League\OAuth2\Client\Provider\GenericProvider;

/**
 * Class Client
 */
class Client
{
    // /**
    //  * @var ConnectorInterface The API connector.
    //  */
    // protected $connector;

    // /**
    //  * @var array<string, mixed> Query strings to be applied to the request.
    //  */
    // protected $query = [];

    // /**
    //  * @var array<string, mixed> Guzzle options to be applied to the request.
    //  */
    // protected $options = [];

    // /**
    //  * @var array<string, mixed> Request options from each individual API call.
    //  */
    // private $requestOptions = [];

    /**
     * @var string The base URI for Acquia Cloud API.
     */
    protected $baseUri;

    /**
     * @var GuzzleClient The client used to make HTTP requests to the API.
     */
    protected $client;

    protected $token;

    protected $provider;

    protected $accessToken;


    /**
     * @inheritdoc
     */
    public function __construct(string $token, string $base_uri = null)
    {
        $this->baseUri = 'https://driftapi.com/';
        if ($base_uri) {
            $this->baseUri = $base_uri;
        }

        $this->client = new GuzzleClient();

        $this->token = $token;

    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * Client factory method for instantiating.
     *
     * @param ConnectorInterface $connector
     *
     * @return static
     */
    public static function factory(ConnectorInterface $connector)
    {
        $client = new static(
            $connector
        );

        return $client;
    }

    /**
     * @inheritdoc
     */
    public function getVersion(): string
    {
        return self::VERSION;
    }


    /**
     * @inheritdoc
     */
    public function request(string $verb, string $path, array $options = [])
    {
        $url = $this->getBaseUri() . $path;

        $response = $this->client->get($url, [
            'headers' => [
                'Authorization' => "Bearer " . $this->token,
            ]
        ]);

        return $this->processResponse($response);
    }


    /**
     * @inheritdoc
     */
    public function processResponse(ResponseInterface $response)
    {

        $body_json = $response->getBody();
        $body = json_decode($body_json);

        var_dump($body);

        // if (property_exists($body, 'data')) {
        //     return $body->data;
        // }

        // if (property_exists($body, 'error') && property_exists($body, 'message')) {
        //     throw new ApiErrorException($body);
        // }

        // return $body;
    }

    /**
     * @inheritdoc
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * @inheritdoc
     */
    public function clearQuery(): void
    {
        $this->query = [];
    }

    /**
     * @inheritdoc
     */
    public function addQuery($name, $value): void
    {
        $this->query = array_merge_recursive($this->query, [$name => $value]);
    }

    /**
     * @inheritdoc
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @inheritdoc
     */
    public function clearOptions(): void
    {
        $this->options = [];
    }

    /**
     * @inheritdoc
     */
    public function addOption($name, $value): void
    {
        $this->options = array_merge_recursive($this->options, [$name => $value]);
    }
}