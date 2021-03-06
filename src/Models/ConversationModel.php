<?php

namespace Drift\Models;

class ConversationModel extends BaseModel
{

    public $id;
    public $participants;
    public $status;
    public $contactId;
    public $inboxId;
    public $createdAt;
    public $updatedAt;
    public $relatedPlaybookId;
    public $conversationTags;

    public function createModel($conversation)
    {
        $this->id = $conversation->id;
        // $this->participants = $conversation->participants;
        $this->status = $conversation->status;
        $this->contactId = $conversation->contactId;
        $this->inboxId = $conversation->inboxId;
        // $this->createdAt = $conversation->createdAt;
        $this->updatedAt = $conversation->updatedAt;
        // $this->relatedPlaybookId = $conversation->relatedPlaybookId;
        // $this->conversationTags = $conversation->conversationTags;
    }
}
