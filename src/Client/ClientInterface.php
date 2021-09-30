<?php

namespace Drift\Client;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Interface ClientInterface
 */
interface ClientInterface
{

    /**
     * @var string VERSION
     */
    public const VERSION = '0.0.1-dev';

    /**
     * @return string
     */
    public function getBaseUri(): string;

    /**
     * Gets the version number of the library
     *
     * @return string
     */
    public function getVersion(): string;

    /**
     * @param  string $verb
     * @param  string $path
     * @param  array<string, mixed> $options
     * @return ResponseInterface
     * @throws ClientException
     */
    public function request(string $verb, string $path, array $options = []);

    /**
     * Processes the returned response from the API.
     *
     * @param  ResponseInterface $response
     * @return mixed
     */
    public function processResponse(ResponseInterface $response);

    /**
     * Get query from Client.
     *
     * @return array<string, mixed>
     */
    public function getQuery(): array;

    /**
     * Clear query.
     */
    public function clearQuery(): void;

    /**
     * Add a query parameter to filter results.
     *
     * @param string     $name
     * @param string|int $value
     */
    public function addQuery($name, $value): void;

    /**
     * Get options from Client.
     *
     * @return array<string, mixed>
     */
    public function getOptions(): array;

    /**
     * Clear options.
     */
    public function clearOptions(): void;

    /**
     * Add an option to the Guzzle request object.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function addOption($name, $value): void;
}
