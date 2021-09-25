<?php

namespace Drift\Endpoints;

/**
 * Class DriftApiBase
 */
abstract class DriftApiBase
{

    /**
     */
    protected $client;

    /**
     * Client constructor.
     *
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
}