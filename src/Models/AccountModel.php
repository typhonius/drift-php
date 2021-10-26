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

    public function __construct($account)
    {
        $account = $this->normaliseModel($account);
        $this->ownerId = $account->ownerId;
        $this->name = $account->name;
        $this->domain = $account->domain;
        $this->accountId = $account->accountId;
        $this->deleted = $account->deleted;
        $this->createDateTime = $account->createDateTime;
        $this->updateDateTime = $account->updateDateTime;
        $this->targeted = $account->targeted;
        // $this->customProperties = $account->customProperties;
    }
}
