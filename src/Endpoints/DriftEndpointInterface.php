<?php

namespace Drift\Endpoints;

interface DriftEndpointInterface
{


    public function get($id);

    public function getAll();

    public function create($id);

    public function update($id, $name, $value);

    public function delete();

}