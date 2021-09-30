<?php

namespace Drift\Endpoints;

use Drift\Response\MeetingList;
use Drift\Response\UserList;
use Drift\Models\UserModel;

class Users extends DriftApiBase
{

    public function get($userId)
    {
        return new UserModel($this->client->request('GET', "users/${userId}"));
    }

    public function getAll()
    {
        return new UserList($this->client->request('GET', 'users/list'));
    }

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

    public function meetings()
    {
        // Change these to not be hard coded.
        $this->client->addQuery('min_start_time', "1609419600000");
        $this->client->addQuery('max_start_time', hrtime(true));
        return new MeetingList($this->client->request('GET', 'users/meetings/org'));
    }
}
