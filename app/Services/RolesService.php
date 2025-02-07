<?php

namespace App\Services;

use App\Interfaces\Repositories\IRolesRepository;
use App\Interfaces\Services\IRolesService;

class RolesService implements IRolesService
{
    protected IRolesRepository $rolesRepository;
    public function __construct(IRolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    public function list()
    {
        return $this->rolesRepository->getAll();
    }
}
