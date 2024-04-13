<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'user_id',
        'forum_id'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
