<?php

namespace App\Interfaces\Services;

use App\Models\Users;

interface IUsersService
{
    public function login($data);
    public function logout($token);
    public function store($data);
    public function update(Users $user, $data);
    public function getUserById($id);
}
