<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['group_name', 'description'];


    public function users()
    {
        return $this->hasOne(GroupUser::class);
    }

    public function groupUsers()
    {
        return $this->hasMany(GroupUser::class);
    }

}
