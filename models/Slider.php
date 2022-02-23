<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = [
      'title',
      'header',
      'image',
      'link'
    ];
}
