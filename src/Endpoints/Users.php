<?php

namespace Drift\Endpoints;

use Drift\Response\UserList;
use Drift\Models\UserModel;

class Users extends DriftApiBase implements DriftEndpointInterface
{



    public function get($userId)
    {
        return new UserModel($this->client->request('GET', "users/${userId}"));
    }

    public function getAll()
    {
        return new UserList($this->client->request('GET', 'users/list'));
    }


    public function create(){}

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