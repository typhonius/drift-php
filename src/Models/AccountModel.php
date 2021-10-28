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
        if ($this->ownerId) {
            $this->ownerId = $account->ownerId;
        }
        if ($this->name) {
            $this->name = $account->name;
        }
        if ($this->domain) {
            $this->domain = $account->domain;
        }
        if ($this->accountId) {
            $this->accountId = $account->accountId;
        }
        if ($this->deleted) {
            $this->deleted = $account->deleted;
        }
        if ($this->createDateTime) {
            $this->createDateTime = $account->createDateTime;
        }
        if ($this->updateDateTime) {
            $this->updateDateTime = $account->updateDateTime;
        }
        if ($this->targeted) {
            $this->targeted = $account->targeted;
        }
        // $this->customProperties = $account->customProperties;
    }
}
