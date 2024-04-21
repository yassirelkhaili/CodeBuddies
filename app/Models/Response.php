<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
        'answer',
        'votes'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function votes() {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function hasUserVoted(int $userId) {
        return $this->votes()->where('user_id', $userId)->exists();
    }
}
