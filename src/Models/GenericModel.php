<?php

namespace Drift\Models;

class GenericModel extends BaseModel implements BaseModelInterface
{

    public function createModel($model)
    {
        foreach ($model as $key => $value) {
            $this->$key = $value;
        }
    }
}
