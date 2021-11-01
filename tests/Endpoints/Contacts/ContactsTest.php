<?php

namespace Drift\Tests\Endpoints\Contacts;

use Drift\Tests\DriftApiTestBase;
use Drift\Endpoints\Contacts;
use Drift\Models\ContactModel;
use Drift\Models\GenericModel;

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

    public function testCreateContact(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Contacts/create.json');
        $client = $this->getMockClient($response);

        $newbie = new ContactModel((object)[
            'attributes' => (object) [
                'email' => 'amalone@drift.com',
            ]
        ]);

        $contacts = new Contacts($client);
        $result = $contacts->create($newbie);

        $expected = new ContactModel((object)[
            'attributes' => (object) [
                'email' => 'basic.contact@email.com',
                'events' => (object)[],
                'socialProfiles' => (object)[],
                'start_date' => 1511336276540
            ],
            'createdAt' => 1511336276540,
            'id' => 444406191,
        ]);

        $this->assertInstanceOf('\Drift\Models\ContactModel', $result);
        $this->assertEquals($expected, $result);
        $this->assertNotEmpty($result);
    }

    public function testCreateTimelineEvent(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Contacts/createTimelineEvent.json');
        $client = $this->getMockClient($response);

        $event = [
            'event' => 'New External Event from <your app>',
            'createdAt' => 1546344000000,
            'contactId' => 1115142980
        ];

        $contacts = new Contacts($client);
        $result = $contacts->createTimelineEvent($event);

        $expected = new GenericModel((object)$event);

        $this->assertInstanceOf('\Drift\Models\GenericModel', $result);
        $this->assertEquals($expected, $result);
        $this->assertNotEmpty($result);
    }
}
