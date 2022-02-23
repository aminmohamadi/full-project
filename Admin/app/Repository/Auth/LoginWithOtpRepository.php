<?php

namespace App\Repository\Auth;

use App\Notifications\SmsActivationCodeNotification;
use App\Notifications\TwoFactorSecurity as TwoFactorSecurityNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Models\ActivationCode;
use Models\User;
use App\Http\Resources\AuthUser;
use Illuminate\Validation\ValidationException;

class LoginWithOtpRepository
{
    protected $user;

    /**
     * Instantiate a new instance
     * @return void
     */
    public function __construct(
        User $user
    )
    {
        $this->user = $user;
    }

    /**
     * Login with otp
     *
     * @return bool|array
     */
    public function login()
    {
        $user = $this->user->whereEmail(request('email'))->first();
        return $this->validateEmailOtp();

    }

    /**
     * Generate email otp
     */
    public function regenerate($user)
    {
        $code = ActivationCode::generateCode($user);
        if ($user->two_factor_type == 'sms') {
            $user->notify(new SmsActivationCodeNotification($code->code));
        }
        if ($user->two_factor_type == 'email') {
            $user->notify(new TwoFactorSecurityNotification($code->code));
        }
    }

    /**
     * Validate email otp
     */
    private function validateEmailOtp(): User
    {
        $user = $this->user->whereEmail(request('email'))->first();
        if ($user) {
            if (Carbon::parse($user->activationCode->expire_at)->gt(now()) && \request()->otp == $user->activationCode->code) {
                $this->reset($user);
                return $user;
            }
        }
        throw ValidationException::withMessages(['OTP is invalid']);


    }


    private function reset(User $user){

        $user->activationCode()->delete();
        request()->session()->forget('auth');

    }
}
