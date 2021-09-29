<?php

namespace Drift\Endpoints;

use Drift\Response\AccountList;
use Drift\Models\AccountModel;

class Accounts extends DriftApiBase implements DriftEndpointInterface
{



    public function get($accountId)
    {
        return new AccountModel($this->client->request('GET', "accounts/${accountId}"));
    }

    public function getAll()
    {
        return new AccountList($this->client->request('GET', 'accounts'));
    }


    public function create($account)
    {
        $options = [
            'json' => $account
        ];
        return new AccountModel($this->client->request('POST', 'accounts/create', $options));
    }

    public function update($userId, $name, $value)
    {

    }

    public function delete(){}

}