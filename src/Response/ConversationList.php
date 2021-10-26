<?php

namespace Drift\Response;

use Drift\Models\ConversationModel;

class ConversationList extends BaseList
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

        $this->setPagination($conversationList);


        // @TODO implement a next method which should look at pagination and return the query required to get the next data
        // Potentially best to have a List class which extends \ArrayObject and use that instead.
    }
}
