<?php

namespace Drift\Response;

use Drift\Models\PlaybookModel;

class PlaybookList extends BaseList
{
    public function __construct($playbookList)
    {
        parent::__construct(
            array_map(
                function ($playbook) {
                    return new PlaybookModel($playbook);
                },
                $playbookList->data
            ),
            self::ARRAY_AS_PROPS
        );
        $this->setPagination($playbookList);
    }
}
