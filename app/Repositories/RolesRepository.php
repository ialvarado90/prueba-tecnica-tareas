<?php

namespace App\Repositories;

use App\Interfaces\Repositories\IRolesRepository;
use App\Models\Roles;

class RolesRepository implements IRolesRepository
{
    public function getAll()
    {
        return Roles::where("status", 1)->get(["id", "name"]);
    }
}
