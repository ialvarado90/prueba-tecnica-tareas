<?php
namespace App\Interfaces\Repositories;

use App\Models\Users;

interface IUsersRepository
{
    public function findByEmail($email);

    public function store($data);

    public function update(Users $user, $data);

    public function findById($id);

    public function getAll();

    public function getAllByRol($rol_id);
}
