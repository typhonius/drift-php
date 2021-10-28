<?php

namespace Drift\Models;

class PlaybookModel extends BaseModel
{

    public $id;
    public $name;
    public $orgId;
    public $meta;
    public $createdAt;
    public $updatedAt;
    public $createdAuthorId;
    public $updatedAuthorId;
    // public $interactionId;
    public $reportType;
    public $goals;

    public function createModel($playbook)
    {
        $this->id = $playbook->id;
        $this->name = $playbook->name;
        $this->orgId = $playbook->orgId;
        $this->meta = $playbook->meta;
        $this->createdAt = $playbook->createdAt;
        $this->updatedAt = $playbook->updatedAt;
        $this->createdAuthorId = $playbook->createdAuthorId;
        $this->updatedAuthorId = $playbook->updatedAuthorId;
        // $this->interactionId = $playbook->interactionId;
        $this->reportType = $playbook->reportType;
        $this->goals = $playbook->goals;
    }
}
