<?php

namespace Drift\Tests\Endpoints\Contacts;

use Drift\Tests\DriftApiTestBase;
use Drift\Endpoints\Users;

class UsersTest extends DriftApiTestBase
{

    public function testGetContact(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Users/get.json');
        $client = $this->getMockClient($response);

        $users = new Users($client);
        $result = $users->get('0bt5b47b-2a06-4816-883e-82592ZZ9908a');

        $this->assertInstanceOf('\Drift\Models\UserModel', $result);
        $this->assertNotEmpty($result);
    }

    public function testGetAllContacts(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Users/getAll.json');
        $client = $this->getMockClient($response);

        $users = new Users($client);
        $result = $users->getAll();

        $this->assertInstanceOf('\Drift\Response\UserList', $result);
        $this->assertNotEmpty($result);

        foreach ($result as $element) {
            $this->assertInstanceOf('\Drift\Models\UserModel', $element);
        }
    }
}
