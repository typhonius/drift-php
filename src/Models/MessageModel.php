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
        if ($message->id) {
            $this->id = $message->id;
        }
        if ($message->userId) {
            $this->userId = $message->userId;
        }
        if ($message->body) {
            $this->body = $message->body;
        }
        if ($message->author) {
            $this->author = $message->author;
        }
        if ($message->type) {
            $this->type = $message->type;
        }
        if ($message->conversationId) {
            $this->conversationId = $message->conversationId;
        }
        if ($message->createdAt) {
            $this->createdAt = $message->createdAt;
        }
        if ($message->buttons) {
            $this->buttons = $message->buttons;
        }
        if ($message->context) {
            $this->context = $message->context;
        }
        if ($message->attributes) {
            $this->attributes = $message->attributes;
        }
    }
}
