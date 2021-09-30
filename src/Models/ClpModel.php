<?php

namespace Drift\Models;

class ClpModel extends BaseModel
{

    public $playbookId;
    public $playbookName;
    public $landingPageUrl;

    public function __construct($playbook)
    {
        $this->playbookId = $playbook->playbookId;
        $this->playbookName = $playbook->playbookName;
        $this->landingPageUrl = $playbook->landingPageUrl;
    }
}
