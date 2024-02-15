<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'user_id', 'enabled', 'published_at'];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected static function booted()
{
    static::creating(function ($post) {
        if (empty($post->slug)) {
            $post->slug = 'default-slug-value'; 
        }
    });
}

}
