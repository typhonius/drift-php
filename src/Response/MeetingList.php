<?php

namespace Drift\Response;

use Drift\Models\MeetingModel;

class MeetingList extends \ArrayObject
{
    public function __construct($meetingList)
    {
        parent::__construct(
            array_map(
                function ($meeting) {
                    return new MeetingModel($meeting);
                },
                $meetingList
            ),
            self::ARRAY_AS_PROPS
        );
    }
}
