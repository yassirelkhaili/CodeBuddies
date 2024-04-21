<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'votable_id',
        'vote_type',
        'votable_type',
    ];

    public function votable() {
        return $this->morphTo();
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
