<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'page_name',
        'route_name',
        'icon',
        'status',
        'parent_id',
        'role_id'
    ];
    public function role() :BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

}
