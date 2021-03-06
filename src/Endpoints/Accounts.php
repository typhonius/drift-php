<?php

namespace Drift\Endpoints;

use Drift\Response\AccountList;
use Drift\Models\AccountModel;
use Drift\Models\GenericModel;

class Accounts extends DriftApiBase
{

    public function get(string $accountId): AccountModel
    {
        return new AccountModel($this->client->request('GET', "accounts/${accountId}"));
    }

    public function getAll(): AccountList
    {
        return new AccountList($this->client->request('GET', 'accounts'));
    }

    public function create(AccountModel $account): AccountModel
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

    public function delete(string $accountId)
    {
        // @TODO need to create a response object for this.
        return new GenericModel($this->client->request('DELETE', "accounts/${accountId}"));
    }
}
