<?php
namespace App\Services;

use App\Interfaces\Services\IUsersTokenService;
use App\Models\Users;

class UsersTokenService implements IUsersTokenService
{
    public function setToken(Users $user)
    {
        return bin2hex(openssl_random_pseudo_bytes(5)) . md5(time()) . $user->id;
    }
}