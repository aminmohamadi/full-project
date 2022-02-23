<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functionality extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable =[
        'name'
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
