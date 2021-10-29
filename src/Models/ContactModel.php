<?php

namespace Drift\Models;

class ContactModel extends BaseModel
{

    public $attributes;
    public $id;
    public $createdAt;

    public function createModel($contact)
    {
        if ($contact->attributes) {
            $this->attributes = $contact->attributes;
        }
        if ($contact->id) {
            $this->id = $contact->id;
        }
        if ($contact->createdAt) {
            $this->createdAt = $contact->createdAt;
        }
    }
}
