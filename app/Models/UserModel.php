<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'id',
        'msisdn',
        'name',
        'access_level',
        'password',
        'mlearn_id'
    ];
}
