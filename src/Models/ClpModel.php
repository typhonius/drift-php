<?php

namespace Drift\Models;

class ClpModel extends BaseModel
{

    public $playbookId;
    public $playbookName;
    public $landingPageUrl;

    public function createModel($playbook)
    {
        $this->playbookId = $playbook->playbookId;
        $this->playbookName = $playbook->playbookName;
        $this->landingPageUrl = $playbook->landingPageUrl;
    }
}
