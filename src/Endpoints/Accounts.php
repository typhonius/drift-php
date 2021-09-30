<?php

namespace Drift\Endpoints;

use Drift\Response\AccountList;
use Drift\Models\AccountModel;

class Accounts extends DriftApiBase
{



    public function get($accountId)
    {
        return new AccountModel($this->client->request('GET', "accounts/${accountId}"));
    }

    public function getAll()
    {
        return new AccountList($this->client->request('GET', 'accounts'));
    }


    public function create(AccountModel $account)
    {
        $options = [
            'json' => $account
        ];
        return new AccountModel($this->client->request('POST', 'accounts/create', $options));
    }

    public function update(AccountModel $account)
    {
        $options = [
            'json' => $account
        ];
        $request = $this->client->request('PATCH', 'accounts/update', $options);
    }

    public function delete($accountId)
    {
        // @TODO need to create a response object for this.
        $this->client->request('DELETE', "accounts/${accountId}");
    }

}