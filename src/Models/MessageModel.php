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
        if ($this->id) {
            $this->id = $message->id;
        }
        if ($this->userId) {
            $this->userId = $message->userId;
        }
        if ($this->body) {
            $this->body = $message->body;
        }
        if ($this->author) {
            $this->author = $message->author;
        }
        if ($this->type) {
            $this->type = $message->type;
        }
        if ($this->conversationId) {
            $this->conversationId = $message->conversationId;
        }
        if ($this->createdAt) {
            $this->createdAt = $message->createdAt;
        }
        if ($this->buttons) {
            $this->buttons = $message->buttons;
        }
        if ($this->context) {
            $this->context = $message->context;
        }
        if ($this->attributes) {
            $this->attributes = $message->attributes;
        }
    }
}
