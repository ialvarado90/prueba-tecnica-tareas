<?php

namespace App\Repositories;

use App\Interfaces\Repositories\IUsersTokenRepository;
use App\Models\UserToken;

class UsersTokenRepository implements IUsersTokenRepository
{
    public function create($data)
    {
        return UserToken::create($data);
    }

    public function deleteByUser($user_id)
    {
        return UserToken::where("users_id", $user_id)->delete();
    }

    public function deleteByToken($token)
    {
        return  UserToken::where("token", $token)->delete();
    }
}
