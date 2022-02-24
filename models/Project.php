<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'body',
        'date',
        'client',
    ];
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
