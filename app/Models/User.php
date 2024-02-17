<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{

    protected $fillable = [
        'name', 'email', 'password', 'post_count'
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
