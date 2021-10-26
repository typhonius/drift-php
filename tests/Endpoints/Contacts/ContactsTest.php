<?php

namespace Drift\Tests\Endpoints\Contacts;

use Drift\Tests\DriftApiTestBase;
use Drift\Endpoints\Contacts;

class ContactsTest extends DriftApiTestBase
{

    public function testGetContact(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Contacts/get.json');
        $client = $this->getMockClient($response);

        $contacts = new Contacts($client);
        $result = $contacts->get('0bt5b47b-2a06-4816-883e-82592ZZ9908a');

        $this->assertInstanceOf('\Drift\Models\ContactModel', $result);
        $this->assertNotEmpty($result);
    }

    public function testGetAllContacts(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Contacts/getAll.json');
        $client = $this->getMockClient($response);

        $contacts = new Contacts($client);
        $result = $contacts->getAll();

        $this->assertInstanceOf('\Drift\Response\ContactList', $result);
        $this->assertNotEmpty($result);

        foreach ($result as $element) {
            $this->assertInstanceOf('\Drift\Models\ContactModel', $element);
        }
    }
}
