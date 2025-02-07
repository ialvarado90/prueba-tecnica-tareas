<?php

namespace App\Repositories;

use App\Interfaces\Repositories\IUsersRepository;
use App\Models\Users;

class UsersRepository implements IUsersRepository
{
    public function findByEmail($email)
    {
        return Users::where('email', $email)->where("status", 1)->first();
    }

    public function store($data)
    {
        return Users::create($data);
    }

    public function update(Users $user, $data)
    {
        return $user->update($data);
    }

    public function findById($id)
    {
        return Users::findOrFail($id);
    }

    public function getAll()
    {
        return Users::where("status", 1)->get();
    }

    public function getAllByRol($rol_id)
    {
        return Users::where("rol_id", $rol_id)->where("status", 1)->get();
    }
}
