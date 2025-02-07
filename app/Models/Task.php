<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $table = "tasks";
    protected $fillable = [
        'users_id',
        'titulo',
        'descripcion',
        'fecha_vencimiento',
        'process',
        'status',
        'created_at',
        'updated_at',
    ];
}
