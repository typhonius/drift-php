<?php

namespace Drift\Response;

use Drift\Models\ConversationModel;

class ConversationList extends \ArrayObject
{
    public function __construct($conversationList)
    {
        parent::__construct(
            array_map(
                function ($conversation) {
                    return new ConversationModel($conversation);
                },
                $conversationList
            ),
            self::ARRAY_AS_PROPS
        );
    }
}