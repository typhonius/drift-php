<?php

namespace Drift\Tests\Endpoints\Accounts;

use Drift\Tests\DriftApiTestBase;
use Drift\Endpoints\Accounts;
use Drift\Models\AccountModel;

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

        $accounts = new Accounts($client);
        $result = $accounts->getAll();

        $this->assertInstanceOf('\Drift\Response\AccountList', $result);
        $this->assertNotEmpty($result);

        foreach ($result as $element) {
            $this->assertInstanceOf('\Drift\Models\AccountModel', $element);
        }
    }

    public function testCreateAccount(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Accounts/create.json');
        $client = $this->getMockClient($response);

        $accounts = new Accounts($client);

        $rawAccount = [
            'ownerId' => 21995,
            'name' => 'Company Name',
            'domain' => 'www.domain.com',
            'deleted' => false,
            'targeted' => true
        ];
        $account = new AccountModel((object) $rawAccount);
        $result = $accounts->create($account);

        $this->assertInstanceOf('\Drift\Models\AccountModel', $result);
        $this->assertNotEmpty($result);
    }
}
