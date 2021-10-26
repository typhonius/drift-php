<?php

namespace Drift\Response;

use Drift\Models\UserModel;

class UserList extends \ArrayObject
{
    public function __construct($userList)
    {
        parent::__construct(
            array_map(
                function ($user) {
                    return new UserModel($user);
                },
                $userList
            ),
            self::ARRAY_AS_PROPS
        );
    }
}
