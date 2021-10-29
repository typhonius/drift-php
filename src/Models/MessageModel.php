<?php

namespace Drift\Models;

class MessageModel extends BaseModel
{

    public $id;
    public $userId;
    public $body;
    public $author;
    public $type;
    public $conversationId;
    public $createdAt;
    public $buttons;
    public $context;
    public $attributes;

    public function createModel($message)
    {
        if (isset($message->id)) {
            $this->id = $message->id;
        }
        if (isset($message->userId)) {
            $this->userId = $message->userId;
        }
        if (isset($message->body)) {
            $this->body = $message->body;
        }
        if (isset($message->author)) {
            $this->author = $message->author;
        }
        if (isset($message->type)) {
            $this->type = $message->type;
        }
        if (isset($message->conversationId)) {
            $this->conversationId = $message->conversationId;
        }
        if (isset($message->createdAt)) {
            $this->createdAt = $message->createdAt;
        }
        if (isset($message->buttons)) {
            $this->buttons = $message->buttons;
        }
        if (isset($message->context)) {
            $this->context = $message->context;
        }
        if (isset($message->attributes)) {
            $this->attributes = $message->attributes;
        }
    }
}
