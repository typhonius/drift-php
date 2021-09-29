<?php

namespace Drift\Response;

use Drift\Models\AccountModel;

class AccountList extends \ArrayObject
{
    public function __construct($accountList)
    {
        parent::__construct(
            array_map(
                function ($account) {
                    return new AccountModel($account);
                },
                $accountList
            ),
            self::ARRAY_AS_PROPS
        );
    }
}