<?php

namespace Drift\Response;

use Drift\Models\MessageModel;

class MessagesList extends BaseList
{
    public function __construct($messagesList)
    {
        parent::__construct(
            array_map(
                function ($message) {
                    return new MessageModel($message);
                },
                $messagesList->data->messages
            ),
            self::ARRAY_AS_PROPS
        );

        $this->setPagination($messagesList);
    }
}
