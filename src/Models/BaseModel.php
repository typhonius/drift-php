<?php

namespace Drift\Models;

class BaseModel implements BaseModelInterface
{

    public function __construct()
    {
    }

    public function normaliseModel($model)
    {
        if (property_exists($model, 'data')) {
            return $model->data;
        }
        return $model;
    }
}
