<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'parent_id',
        'commentable_id',
        'commentable_type',
        'approved'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id','id')
            ->where('approved', '=', 1)->latest();
    }

}
