<?php

namespace Drift\Models;

class ConversationModel
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

    public function __construct($conversation)
    {
        // $this->id = $conversation->id;
        // $this->participants = $conversation->participants;
        // $this->status = $conversation->status;
        // $this->contactId = $conversation->contactId;
        // $this->inboxId = $conversation->inboxId;
        // $this->createdAt = $usconversationer->createdAt;
        // $this->updatedAt = $conversation->updatedAt;
        // $this->relatedPlaybookId = $conversation->relatedPlaybookId;
        // $this->conversationTags = $conversation->conversationTags;
        var_dump($conversation);
    }

}