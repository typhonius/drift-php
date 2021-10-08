<?php

namespace Drift\Client;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Client
 */
class Client implements ClientInterface
{

    /**
     * @var array<string, mixed> Query strings to be applied to the request.
     */
    protected $query = [];

    /**
     * @var array<string, mixed> Guzzle options to be applied to the request.
     */
    protected $options = [];

    /**
     * @var array<string, mixed> Request options from each individual API call.
     */
    private $requestOptions = [];

    /**
     * @var string The base URL for Drift API.
     */
    protected $baseUri;

    /**
     * @var GuzzleClient The client used to make HTTP requests to the API.
     */
    private $client;

    /**
     * @var token The secret token used to authenticate API calls.
     */
    private $token;


    /**
     * @inheritdoc
     */
    public function __construct(string $token, string $base_uri = null)
    {
        $this->token = $token;

        $this->baseUri = 'https://driftapi.com';
        if ($base_uri) {
            $this->baseUri = $base_uri;
        }

        $this->client = new GuzzleClient(['base_uri' => $this->baseUri]);
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
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

        $options['headers'] = [
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $userAgent = sprintf(
            "%s/%s (https://github.com/typhonius/drift-php)",
            'drift-php',
            $this->getVersion()
        );

        $options['headers']['User-Agent'] = $userAgent;
        $options['query'] = $this->query;

        try {
            $response = $this->client->$verb($path, $options);
        } catch (ClientException $response) {
            // @TODO Consider using the following as Guzzle truncates the error message
            // $response = json_decode($ex->getResponse()->getBody()->getContents(), true);
            echo $response->getMessage();
            exit;
        }

        return $this->processResponse($response);
    }


    /**
     * @inheritdoc
     */
    public function processResponse(ResponseInterface $response)
    {

        // Required for getTranscript - we need a new method here.
        // $body_json = $response->getBody()->getContents();

        // var_dump($response);
        $body_json = $response->getBody();
        $body = json_decode($body_json);
        return $body;
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
