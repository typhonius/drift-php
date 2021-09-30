<?php

namespace Drift\Response;

use Drift\Models\PlaybookModel;

class PlaybookList extends \ArrayObject
{
    public function __construct($playbookList)
    {
        parent::__construct(
            array_map(
                function ($playbook) {
                    return new PlaybookModel($playbook);
                },
                $playbookList
            ),
            self::ARRAY_AS_PROPS
        );
    }
}