<?php

namespace Drift\Endpoints;

use Drift\Response\ContactList;
use Drift\Models\ContactModel;

class Contacts extends DriftApiBase
{
    public function get($contactId)
    {
        return new ContactModel($this->client->request('GET', "contacts/${contactId}"));
    }

    public function getAll()
    {
        // @TODO remove this hardcoded query.
        $this->client->addQuery('email', 'amalone@drift.com');
        return new ContactList($this->client->request('GET', 'contacts'));
    }

    public function create(ContactModel $contact)
    {
        $options = [
            'json' => $contact
        ];
        $request = $this->client->request('POST', 'contacts', $options);
    }

    public function update($userId, $name, $value)
    {
        $options = [
            'json' => [
                $name => $value,
            ],
        ];
        $this->client->addQuery('userId', $userId);
        // @TODO work out what gets returned here.
        $request = $this->client->request('PATCH', 'users/update', $options);
    }

    public function delete($contactId)
    {
        // @TODO see if there's some way we can provide something here.
        return $this->client->request('DELETE', "contacts/${contactId}");
    }
}
