<?php

namespace Drift\Endpoints;

use Drift\Response\ConversationList;
use Drift\Models\ConversationModel;

class Conversations extends DriftApiBase implements DriftEndpointInterface
{



    public function get($conversationId)
    {
        return new ConversationModel($this->client->request('GET', "/conversations/${conversationId}"));
    }

    public function getAll()
    {
        return new ConversationList($this->client->request('GET', '/conversations/list'));
    }

    public function getMessages($conversationId)
    {
        return new MessagesList($this->client->request('GET', "/conversations/${conversationId}/messages"));
    }

    public function getTranscript($conversationId)
    {
        return $this->client->request('GET', "/conversations/${conversationId}/transcript");
    }

    public function getJsonTranscript($conversationId)
    {
        return $this->client->request('GET', "/conversations/${conversationId}/json_transcript");
    }


    public function create($conversationDetails)
    {
        $options = [
            'json' => [
                $conversationDetails,
            ],
        ];

        return $this->client->request('POST', '/conversations/new', $options);
    }

    public function update($userId, $name, $value)
    {
    }

    public function delete(){}

}