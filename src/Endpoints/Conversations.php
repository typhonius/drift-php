<?php

namespace Drift\Endpoints;

use Drift\Response\ConversationList;
use Drift\Models\ConversationModel;
use Drift\Response\MessagesList;
use Drift\Models\MessageModel;

class Conversations extends DriftApiBase
{

    public function get($conversationId)
    {
        return new ConversationModel($this->client->request('GET', "conversations/${conversationId}"));
    }

    public function getAll()
    {
        return new ConversationList($this->client->request('GET', 'conversations/list'));
    }

    public function getMessages($conversationId)
    {
        return new MessagesList($this->client->request('GET', "conversations/${conversationId}/messages"));
    }

    public function getTranscript($conversationId)
    {
        return $this->client->request('GET', "conversations/${conversationId}/transcript");
    }

    public function getJsonTranscript($conversationId)
    {
        return $this->client->request('GET', "conversations/${conversationId}/json_transcript");
    }


    public function create($conversation)
    {
        $options = [
            'json' => $conversation,
        ];

        return $this->client->request('POST', 'conversations/new', $options);
    }

    public function sendMessage($conversationId, MessageModel $message)
    {
        $options = [
            'json' => $message,
        ];

        return new MessageModel($this->client->request('POST', "conversations/${conversationId}/messages", $options));
    }

    // @TODO This may need to be streamed so weould need a new $client->stream method. At the very least we'll need to give it a destination.
    public function getAttachments($documentId)
    {
        return $this->client->request('GET', "attachments/${documentId}/data");
    }

    public function getConversationStats()
    {
        return $this->client->request('GET', 'conversations/stats');
    }
}
