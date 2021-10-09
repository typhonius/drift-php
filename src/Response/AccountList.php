<?php

namespace Drift\Response;

use Drift\Models\AccountModel;

class AccountList extends BaseList
{
    public function __construct($accountList)
    {
        parent::__construct(
            array_map(
                function ($account) {
                    return new AccountModel($account);
                },
                $accountList->data->accounts
            ),
            self::ARRAY_AS_PROPS
        );

        $this->setPagination($accountList->data);
    }
}
