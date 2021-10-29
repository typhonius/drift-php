<?php

namespace Drift\Models;

class ContactModel extends BaseModel
{

    public $attributes;
    public $id;
    public $createdAt;

    public function createModel($contact)
    {
        if (isset($contact->attributes)) {
            $this->attributes = $contact->attributes;
        }
        if (isset($contact->id)) {
            $this->id = $contact->id;
        }
        if (isset($contact->createdAt)) {
            $this->createdAt = $contact->createdAt;
        }
    }
}
