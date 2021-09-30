<?php

namespace Drift\Models;

class ContactModel extends BaseModel
{

    public $attributes;
    public $id;
    public $createdAt;

    public function __construct($contact)
    {
        $this->attributes = $contact->attributes;
        $this->id = $contact->id;
        $this->createdAt = $contact->createdAt;
    }
}
