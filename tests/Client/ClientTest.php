<?php

namespace Drift\Tests\Client;

use Drift\Tests\DriftApiTestBase;
use Drift\Client;

class ClientTest extends DriftApiTestBase
{

    public function testAddQuery(): void
    {
        $client = $this->getMockClient();

        $client->addQuery('filter', 'name=dev');
        $client->addQuery('filter', 'type=file');

        $expectedQuery = [
            'filter' => [
                'name=dev',
                'type=file',
            ],
        ];

        $this->assertEquals($expectedQuery, $client->getQuery());
    }

    public function testClearQuery(): void
    {
        $client = $this->getMockClient();

        $client->addQuery('filter', 'name=dev');
        $this->assertEquals(['filter' => 'name=dev'], $client->getQuery());

        $client->clearQuery();
        $this->assertTrue(empty($client->getQuery()));
    }

    public function testOptions(): void
    {
        $client = $this->getMockClient();

        $client->addOption('verify', 'false');
        $client->addOption('curl.options', ['CURLOPT_RETURNTRANSFER' => true]);
        $client->addOption('curl.options', ['CURLOPT_FILE' => '/tmp/foo']);

        $expectedOptions = [
            'verify' => 'false',
            'curl.options' => [
                'CURLOPT_RETURNTRANSFER' => true,
                'CURLOPT_FILE' => '/tmp/foo',
            ],
        ];

        $this->assertEquals($expectedOptions, $client->getOptions());

        $client->clearOptions();
        $this->assertTrue(empty($client->getOptions()));
    }

    public function testModifyOptions(): void
    {
        $client = $this->getMockClient();

        // Set a number of options and queries as a dependent library would.
        $client->addOption('headers', ['User-Agent' => 'DriftCli/4.20']);
        // Add a user agent twice to ensure that we only see it once in the request.
        $client->addOption('headers', ['User-Agent' => 'DriftCli/4.20']);
        $client->addOption('headers', ['User-Agent' => 'ZCli/1.1.1']);
        $client->addOption('headers', ['User-Agent' => 'AaahCli/0.1']);
        $client->addQuery('limit', '1');

        // Set options as an endpoint call would.
        $reflectionClass = new \ReflectionClass('Drift\Client\Client');

        $requestOptions = [
            'json' => [
                'source' => 'source',
                'message' => 'message',
            ],
        ];

        $providerProperty = $reflectionClass->getProperty('requestOptions');
        $providerProperty->setAccessible(true);
        $providerProperty->setValue($client, $requestOptions);

        // $client->modifyOptions();
        $client->modifyOptions();
        $actualOptions = $client->modifyOptions();

        $version = $client->getVersion();
        $expectedOptions = [
            'headers' => [
                'User-Agent' => sprintf('drift-php/%s (https://github.com/typhonius/drift-php) DriftCli/4.20 ZCli/1.1.1 AaahCli/0.1', $version),
                'Authorization' => 'Bearer token'
            ],
            'json' => [
                'source' => 'source',
                'message' => 'message'
            ],
            'query' => [
                'limit' => '1'
            ]
        ];

        $this->assertEquals($expectedOptions, $actualOptions);
    }

    public function testVersion(): void
    {
        $reflectionClass = new \ReflectionClass('Drift\Client\Client');
        $constants = $reflectionClass->getConstants();
        $reflectionVersion = $constants['VERSION'];

        $client = $this->getMockClient();
        $methodVersion = $client->getVersion();

        $this->assertEquals($methodVersion, $reflectionVersion);
    }
}
