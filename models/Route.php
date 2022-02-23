<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $table='routes';
    public $timestamps = false;

    protected $fillable = [
      'name',
      'path',
        'component',
        'rule',
        'page_title',
        'breadcrumb',
        'auth_required',
        'parent'
    ];

}
