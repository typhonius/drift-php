<?php

namespace Drift\Tests\Endpoints;

use Drift\Tests\DriftApiTestBase;
use Drift\Endpoints\Accounts;

class AccountsTest extends DriftApiTestBase
{

    public function testGetAccount(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Accounts/get.json');
        $client = $this->getMockClient($response);

        $accounts = new Accounts($client);
        $result = $accounts->get('0bt5b47b-2a06-4816-883e-82592ZZ9908a');

        $this->assertInstanceOf('\Drift\Models\AccountModel', $result);
        $this->assertNotEmpty($result);
    }

    public function testGetAllAccounts(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Accounts/getAll.json');
        $client = $this->getMockClient($response);

        $application = new Accounts($client);
        $result = $application->getAll();

        $this->assertInstanceOf('\Drift\Response\AccountList', $result);
        $this->assertNotEmpty($result);

        foreach ($result as $element) {
            $this->assertInstanceOf('\Drift\Models\AccountModel', $element);
        }
    }
}
