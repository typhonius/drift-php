<?php

namespace Drift\Models;

abstract class BaseModel implements BaseModelInterface
{

    public function __construct($model)
    {
        $this->createModel($this->normaliseModel($model));
    }

    public function normaliseModel($model)
    {
        if (property_exists($model, 'data')) {
            return $model->data;
        }
        return $model;
    }
}
