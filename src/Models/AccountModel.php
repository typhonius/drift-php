<?php

namespace Drift\Models;

class AccountModel extends BaseModel implements BaseModelInterface
{

    public $ownerId;
    public $name;
    public $domain;
    public $accountId;
    public $deleted;
    public $createDateTime;
    public $updateDateTime;
    public $targeted;
    public $customProperties;

    public function createModel($account)
    {
        if (isset($account->ownerId)) {
            $this->ownerId = $account->ownerId;
        }
        if (isset($account->name)) {
            $this->name = $account->name;
        }
        if (isset($account->domain)) {
            $this->domain = $account->domain;
        }
        if (isset($account->accountId)) {
            $this->accountId = $account->accountId;
        }
        if (isset($account->deleted)) {
            $this->deleted = $account->deleted;
        }
        if (isset($account->createDateTime)) {
            $this->createDateTime = $account->createDateTime;
        }
        if (isset($account->updateDateTime)) {
            $this->updateDateTime = $account->updateDateTime;
        }
        if (isset($account->targeted)) {
            $this->targeted = $account->targeted;
        }
        // $this->customProperties = $account->customProperties;
    }
}
