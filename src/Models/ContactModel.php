<?php

namespace Drift\Models;

class ContactModel extends BaseModel
{

    public $attributes;
    public $id;
    public $createdAt;

    public function createModel($contact)
    {
        if ($this->attributes) {
            $this->attributes = $contact->attributes;
        }
        if ($this->id) {
            $this->id = $contact->id;
        }
        if ($this->createdAt) {
            $this->createdAt = $contact->createdAt;
        }
    }
}
