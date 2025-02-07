<?php
namespace App\Interfaces\Services;

use App\Models\Users;

interface IUsersTokenService
{
    public function setToken(Users $user);
}