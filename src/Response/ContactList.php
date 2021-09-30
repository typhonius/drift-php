<?php

namespace Drift\Response;

use Drift\Models\ContactModel;

class ContactList extends \ArrayObject
{
    public function __construct($contactList)
    {
        parent::__construct(
            array_map(
                function ($contact) {
                    return new ContactModel($contact);
                },
                $contactList
            ),
            self::ARRAY_AS_PROPS
        );
    }
}