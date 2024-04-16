<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'thread_id'
    ];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
