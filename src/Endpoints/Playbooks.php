<?php

namespace Drift\Endpoints;

use Drift\Response\PlaybookList;
use Drift\Response\ClpList;

class Playbooks extends DriftApiBase
{

    public function getAll()
    {
        return new PlaybookList($this->client->request('GET', 'playbooks/list'));
    }

    public function getAllClp()
    {
        return new ClpList($this->client->request('GET', 'playbooks/clp'));
    }
}