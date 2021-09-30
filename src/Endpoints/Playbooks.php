<?php

namespace Drift\Endpoints;

use Drift\Response\MeetingList;
use Drift\Response\UserList;
use Drift\Models\UserModel;

class Playbooks extends DriftApiBase
{

    public function getAll()
    {
        return new PlaybookList($this->client->request('GET', 'playbooks/list'));
    }

    public function getAllClp()
    {
        // @TODO do we need a model for CLPs?
        $this->client->request('GET', 'playbooks/clp');
    }
}