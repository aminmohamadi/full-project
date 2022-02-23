<?php

namespace Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'phone',
        'password',
        'last_name',
        'first_name',
        'gender',
        'status',
        'national_code',
        'permissions',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['last_login'];

    public static function registered($email)
    {
        return static::where('email', $email)->exists();
    }

    public static function findByEmail($email)
    {
        return static::where('email', $email)->first();
    }

    public static function totalCustomers()
    {
        return Role::findOrNew(setting('customer_role'))->users()->count();
    }

    /**
     * Login the user.
     *
     * @return $this|bool
     */
    public function login()
    {
        return auth()->login($this);
    }


    /**
     * Checks if a user belongs to the given Role ID.
     *
     * @param int $roleId
     * @return bool
     */
    public function hasRoleId($roleId)
    {
        return $this->roles()->whereId($roleId)->count() !== 0;
    }

    /**
     * Checks if a user belongs to the given Role Name.
     *
     * @param string $name
     * @return bool
     */
    public function hasRoleName($name)
    {
        return $this->roles()->whereTranslation('name', $name)->count() !== 0;
    }

    /**
     * Check if the current user is activated.
     *
     * @return bool
     */
    public function isActivated()
    {
        return Activation::completed($this);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get the full name of the user.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getRoleNameAttribute()
    {
        return $this->role->title;
    }

    /**
     * Determine if the user has access to the given permissions.
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAccess($permission)
    {
        $access = Functionality::where('name',$permission)->whereHas('roles', function($query) {
            $query->where('role_id', auth()->user()->role->id);
        })->get();
        if ($access->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function menu()
    {
        return $this->role->available_menu();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);

    }

    public function products()
    {
        return 221;
    }

    public function activationCode(){
        return $this->hasOne(ActivationCode::class);
    }

}
