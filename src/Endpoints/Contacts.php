<?php

namespace Drift\Endpoints;

use Drift\Response\ContactList;
use Drift\Models\ContactModel;
use Drift\Models\GenericModel;

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
        return new ContactModel($this->client->request('POST', 'contacts', $options));
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
        // Narrator: There wasn't.
        return $this->client->request('DELETE', "contacts/${contactId}");
    }

    // @TODO this needs testing. Docs are crap.
    public function unsubscribe(array $emails)
    {
        $options = [
            'json' => $emails
        ];
        return $this->client->request('POST', 'emails/unsubscribe', $options);
    }

    // @TODO this needs testing - docs also crap
    public function createTimelineEvent(array $update)
    {
        // Do we put validation here? We need a contactId (or externalId) and event name.
        // Could look at using named arguments...?
        $options = [
            'json' => $update
        ];
        return new GenericModel($this->client->request('POST', 'contacts/timeline', $options));
    }

    public function getCustomAttributes()
    {
        return $this->client->request('GET', 'contacts/attributes');
    }
}
