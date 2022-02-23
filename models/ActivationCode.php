<?php

namespace Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'code',
        'used',
        'expire_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGenerateCode($query, $user)
    {
        do {
            $code = mt_rand(100000, 999999);
        } while ($this->checkCodeIsUnique($user, $code));
        $user->activationCode()->delete();
        $code = $user->activationCode()->create([
            'code' => $code,
            'expire_at' => Carbon::now()->addMinutes(3)
        ]);
        return $code;
    }

    public function scopeVerifyCode($query, $code, $user)
    {
        return !!$user->activationCode()->where('code','=',$code)->where('expire_at', '>', now())->first();
    }

    private function checkCodeIsUnique($user, $code)
    {
        return !!$user->activationCode()->whereCode($code)->first();
    }

    private function getAliveCode($user)
    {
        $user->activationCode->where('expire_at', '>', now())->first();

    }
}

