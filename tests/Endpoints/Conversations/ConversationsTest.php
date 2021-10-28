<?php

namespace Drift\Tests\Endpoints\Accounts;

use Drift\Tests\DriftApiTestBase;
use Drift\Endpoints\Conversations;
use Drift\Models\MessageModel;

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

    public function testGetMessages(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Messages/get.json');
        $client = $this->getMockClient($response);

        $conversations = new Conversations($client);
        $result = $conversations->getMessages('1230200520');

        $this->assertInstanceOf('\Drift\Response\MessagesList', $result);
        $this->assertNotEmpty($result);

        foreach ($result as $element) {
            $this->assertInstanceOf('\Drift\Models\MessageModel', $element);
        }
    }

    public function testCreateMessage(): void
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/Messages/create.json');
        $client = $this->getMockClient($response);

        $conversations = new Conversations($client);

        $rawMessage = [
            'userId' => 12345,
            'body' => 'o hai',
            'type' => 'chat',
        ];
        $message = new MessageModel((object) $rawMessage);
        $result = $conversations->sendMessage('1230200520', $message);

        $this->assertInstanceOf('\Drift\Models\MessageModel', $result);
        $this->assertNotEmpty($result);
    }
}
