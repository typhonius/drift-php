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
        if ($account->ownerId) {
            $this->ownerId = $account->ownerId;
        }
        if ($account->name) {
            $this->name = $account->name;
        }
        if ($account->domain) {
            $this->domain = $account->domain;
        }
        if ($account->accountId) {
            $this->accountId = $account->accountId;
        }
        if ($account->deleted) {
            $this->deleted = $account->deleted;
        }
        if ($account->createDateTime) {
            $this->createDateTime = $account->createDateTime;
        }
        if ($account->updateDateTime) {
            $this->updateDateTime = $account->updateDateTime;
        }
        if ($account->targeted) {
            $this->targeted = $account->targeted;
        }
        // $this->customProperties = $account->customProperties;
    }
}
