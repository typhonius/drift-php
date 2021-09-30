<?php

namespace Drift\Response;

use Drift\Models\ClpModel;

class ClpList extends \ArrayObject
{
    public function __construct($clpList)
    {
        parent::__construct(
            array_map(
                function ($clp) {
                    return new ClpModel($clp);
                },
                $clpList
            ),
            self::ARRAY_AS_PROPS
        );
    }
}