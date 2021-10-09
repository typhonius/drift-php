<?php

namespace Drift\Models;

class MessageModel extends BaseModel
{

    public $id;
    public $orgId;
    public $body;
    public $author;
    public $type;
    public $conversationId;
    public $createdAt;
    public $buttons;
    public $context;
    public $attributes;

    public function __construct($message)
    {
        $this->id = $message->id;
        $this->orgId = $message->orgId;
        $this->body = $message->body;
        $this->author = $message->author;
        $this->type = $message->type;
        $this->conversationId = $message->conversationId;
        $this->createdAt = $message->createdAt;
        $this->buttons = $message->buttons;
        $this->context = $message->context;
        $this->attributes = $message->attributes;
    }
}
