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
     * @var string The secret token used to authenticate API calls.
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

        $client = new GuzzleClient(['base_uri' => $this->baseUri]);
        $this->setClient($client);
    }

    public function setClient($client)
    {
        $this->client = $client;
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

    public function modifyOptions()
    {
        // Combine options set globally e.g. headers with options set by individual API calls e.g. form_params.
        $options = $this->options + $this->requestOptions;

        $options['headers']['Authorization'] = 'Bearer ' . $this->token;

        $userAgent = sprintf(
            "%s/%s (https://github.com/typhonius/drift-php)",
            'drift-php',
            $this->getVersion()
        );

        if (isset($options['headers']['User-Agent']) && is_array($options['headers']['User-Agent'])) {
            array_unshift($options['headers']['User-Agent'], $userAgent);
            $options['headers']['User-Agent'] = implode(' ', array_unique($options['headers']['User-Agent']));
        } else {
            $options['headers']['User-Agent'] = $userAgent;
        }

        $options['query'] = $this->query;

        return $options;
    }

    /**
     * @inheritdoc
     */
    public function request(string $verb, string $path, array $options = [])
    {

        // Put options sent with API calls into a property so they can be accessed
        // and therefore tested in tests.
        $this->requestOptions = $options;

        // Modify the options to combine options set as part of the API call as well
        // as those set by tools extending this library.
        $modifiedOptions = $this->modifyOptions();

        try {
            $response = $this->client->$verb($path, $modifiedOptions);
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

        // @TODO if there's a data element AND inside that is an array then it'll be a list
        // if there's a data element AND a single object inside it won't be.
        // Sometimes there won't be a data element (wtf)
        // We should make it consistent and remove the data element before passing back either an object or an array

        // Arrghhh but that then breaks pagination because data and pagination are siblings (at least for conversations)
        // if (property_exists($body, 'data')) {
        //     return $body->data;
        // }

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
