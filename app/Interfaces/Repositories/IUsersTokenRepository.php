<?php
namespace App\Interfaces\Repositories;

interface IUsersTokenRepository
{
    public function create($data);
    public function deleteByUser($user_id);
    public function deleteByToken($token);
}
