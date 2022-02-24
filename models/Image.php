<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'commentable_id',
        'commentable_type',
        'alt',
        'address'
    ];
    public $timestamps = false;

    public function imageable()
    {
        return $this->morphTo();
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
