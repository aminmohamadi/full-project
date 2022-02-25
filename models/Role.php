<?php

namespace Models;

use Cartalyst\Sentinel\Roles\EloquentRole;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use Sluggable;
    public $timestamps = false;
    protected $fillable =[
      'name',
      'slug',
      'permissions'
    ];
    /**
     * Get a list of all roles.
     *
     * @return array
     */
    public static function list()
    {
        return static::select('id')->get()->pluck('name', 'id');
    }

    /**
     * The Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

       public function menu()
    {
        return $this->hasMany(Menu::class);
    }

    public function available_menu(){
        return $this->menu()->where('parent_id','=',0)->where('status','=',1)->get();
    }

    public function functionalities()
    {
        return $this->belongsToMany(Functionality::class);
    }


}
