<?php

namespace Drift\Tests;

use Drift\Client\Client;
use Drift\Client\ClientInterface;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

/**
 * Class DriftApiTest
 */
abstract class DriftApiTestBase extends TestCase
{

    /**
     * Returns a PSR7 stream for a given raw JSON string.
     *
     * @param string $string The string to create the stream for.
     * @return Stream
     */
    protected function getPsr7StreamForString($string): Stream
    {
        $stream = Utils::streamFor($string);
        $this->assertInstanceOf(Stream::class, $stream);

        return $stream;
    }

    /**
     * Returns a PSR7 Stream for a given fixture.
     *
     * @param  string $fixture The fixture to create the stream for.
     * @return Stream
     */
    protected function getPsr7StreamForFixture($fixture): Stream
    {
        $path = sprintf('%s/Fixtures/%s', __DIR__, $fixture);
        $this->assertFileExists($path);
        $stream = $this->getPsr7StreamForString(file_get_contents($path));

        return $stream;
    }

    /**
     * Returns a PSR7 Response (JSON) for a given fixture.
     *
     * @param  string  $fixture    The fixture to create the response for.
     * @param  integer $statusCode A HTTP Status Code for the response.
     * @return Response
     */
    protected function getPsr7JsonResponseForFixture($fixture, $statusCode = 200): Response
    {
        $stream = $this->getPsr7StreamForFixture($fixture);
        $this->assertNotNull(json_decode($stream));
        $this->assertEquals(JSON_ERROR_NONE, json_last_error());

        return new Response($statusCode, ['Content-Type' => 'application/json'], $stream);
    }

    /**
     * Returns a PSR7 Response (Gzip) for a given fixture.
     *
     * @param  string  $fixture    The fixture to create the response for.
     * @param  integer $statusCode A HTTP Status Code for the response.
     * @return Response
     */
    protected function getPsr7GzipResponseForFixture($fixture, $statusCode = 200): Response
    {
        $stream = $this->getPsr7StreamForFixture($fixture);

        return new Response($statusCode, ['Content-Type' => 'application/octet-stream'], $stream);
    }

    /**
     * Mock client class.
     *
     * @param  mixed $response
     */
    protected function getMockClient($response = '')
    {

        $driftClient = new Client('token');

        if ($response) {
            $mock = new MockHandler([$response]);
            $handlerStack = HandlerStack::create($mock);
            $client = new GuzzleClient(['handler' => $handlerStack]);
            $driftClient->setClient($client);
        }

        return $driftClient;
    }

    /**
     * Uses reflection to retrieve the internal request options to test passed parameters.
     *
     * @param  ClientInterface $client
     * @return array{json:array}
     */
    protected function getRequestOptions($client): array
    {
        $reflectionClass = new \ReflectionClass('Drift\Client\Client');
        $property = $reflectionClass->getProperty('requestOptions');
        $property->setAccessible(true);
        return $property->getValue($client);
    }
}
