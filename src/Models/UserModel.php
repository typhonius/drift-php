<?php

namespace Drift\Models;

class UserModel
{

    public $id;
    public $orgId;
    public $name;
    public $alias;
    public $email;
    public $availability;
    public $role;
    public $avatarUrl;
    public $verified;
    public $bot;
    public $createdAt;
    public $updatedAt;

    public function __construct($user)
    {
        $this->id = $user->id;
        $this->orgId = $user->orgId;
        $this->name = $user->name;
        $this->alias = $user->alias;
        $this->email = $user->email;
        $this->availability = $user->availability;
        $this->role = $user->role;
        $this->avatarUrl = $user->avatarUrl;
        $this->verified = $user->verified;
        $this->bot = $user->bot;
        $this->createdAt = $user->createdAt;
        $this->updatedAt = $user->updatedAt;
    }

}