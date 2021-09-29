<?php

namespace Drift\Endpoints;

use Drift\Response\UserList;
use Drift\Models\UserModel;

class Contacts extends DriftApiBase implements DriftEndpointInterface
{



    public function get($contactId)
    {
        return $this->client->request('GET', "contacts/${contactId}");
    }

    public function getAll()
    {
        $this->client->addQuery('email', 'amalone@drift.com');
        $contacts = $this->client->request('GET', 'contacts');
        // var_dump($contacts);
        foreach ($contacts as $c) {
            var_dump($c->attributes);
        }
    }


    public function create($details){}

    public function update($userId, $name, $value)
    {
        $options = [
            'json' => [
                $name => $value,
            ],
        ];
        $this->client->addQuery('userId', $userId);
        $request = $this->client->request('PATCH', 'users/update', $options);
    }

    public function delete(){}

}