<?php

namespace Drift\Tests\Endpoints\Playbooks;

use Drift\Tests\DriftApiTestBase;
use Drift\Endpoints\Playbooks;

class PlaybooksTest extends DriftApiTestBase
{

    public function testGetAllPlaybooks(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Playbooks/getAllPlaybooks.json');
        $client = $this->getMockClient($response);

        $playbooks = new Playbooks($client);
        $result = $playbooks->getAll();

        $this->assertInstanceOf('\Drift\Response\PlaybookList', $result);
        $this->assertNotEmpty($result);

        foreach ($result as $element) {
            $this->assertInstanceOf('\Drift\Models\PlaybookModel', $element);
        }
    }

    public function testGetAllClpPlaybooks(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Playbooks/getAllClpPlaybooks.json');
        $client = $this->getMockClient($response);

        $playbooks = new Playbooks($client);
        $result = $playbooks->getAllClp();

        $this->assertInstanceOf('\Drift\Response\ClpList', $result);
        $this->assertNotEmpty($result);

        foreach ($result as $element) {
            $this->assertInstanceOf('\Drift\Models\ClpModel', $element);
        }
    }
}
