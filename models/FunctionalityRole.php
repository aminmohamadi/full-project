<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionalityRole extends Model
{
    use HasFactory;
    protected $table = 'functionality_role';

    public function functionalities(){
        return $this->belongsTo(Functionality::class,'functionality_id');
    }
}
