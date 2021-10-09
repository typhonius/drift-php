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

    public function meetings($startTime = null, $endTime = null)
    {
        // Default start time up to 30 days ago.
        $startTime = $startTime ?: round(microtime(true) * 1000) - 2592000000;
        $endTime = $endTime ?: round(microtime(true) * 1000);

        $this->client->addQuery('min_start_time', $startTime);
        $this->client->addQuery('max_start_time', $endTime);
        return new MeetingList($this->client->request('GET', 'users/meetings/org'));
    }
}
