<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    use HasFactory;

    protected $table = 'users_token';
    
    protected $fillable = [
        'id',
        'token',
        'users_id',
        'created_at',
        'updated_at',
    ];
}
