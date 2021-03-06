<?php

namespace Drift\Tests\Endpoints\Contacts;

use Drift\Tests\DriftApiTestBase;
use Drift\Endpoints\Users;
use GuzzleHttp\Psr7\Response;

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

    public function testGetBookedMeetings(): void
    {

        // @TODO need to ensure max_start_time and min_start_time are set properly too.

        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Meetings/get.json');
        $client = $this->getMockClient($response);

        $users = new Users($client);
        $result = $users->meetings();

        $this->assertInstanceOf('\Drift\Response\MeetingList', $result);
        $this->assertNotEmpty($result);

        foreach ($result as $element) {
            $this->assertInstanceOf('\Drift\Models\MeetingModel', $element);
        }
    }

    public function testDelete(): void
    {
        // @TODO create a trait for this.
        $stream = $this->getPsr7StreamForString('');
        $response = new Response(200, ['Content-Type' => 'application/json'], $stream);
        $client = $this->getMockClient($response);

        $users = new Users($client);
        $update = [
            'alias' => 'Adam (online)',
            'availability' => 'AVAILABLE'
        ];
        $result = $users->update(21965, $update);

        // Assert the response is NULL because that's what the API gives us back... even though the docs say otherwise!
        $this->assertEmpty($result);
    }
}
