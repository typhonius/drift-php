<?php

namespace Drift\Tests\Endpoints\Accounts;

use Drift\Tests\DriftApiTestBase;
use Drift\Endpoints\Conversations;

class ConversationsTest extends DriftApiTestBase
{

    public function testGetConversation(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Conversations/get.json');
        $client = $this->getMockClient($response);

        $conversations = new Conversations($client);
        $result = $conversations->get('0bt5b47b-2a06-4816-883e-82592ZZ9908a');

        $this->assertInstanceOf('\Drift\Models\ConversationModel', $result);
        $this->assertNotEmpty($result);
    }

    public function testGetAllConversations(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Conversations/getAll.json');
        $client = $this->getMockClient($response);

        $conversations = new Conversations($client);
        $result = $conversations->getAll();

        $this->assertInstanceOf('\Drift\Response\ConversationList', $result);
        $this->assertNotEmpty($result);

        foreach ($result as $element) {
            $this->assertInstanceOf('\Drift\Models\ConversationModel', $element);
        }
    }
}
