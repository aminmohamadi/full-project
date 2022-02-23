<?php

namespace App\Traits;

use App\Notifications\SmsActivationCodeNotification;
use Carbon\Carbon;
use App\Notifications\TwoFactorSecurity as TwoFactorSecurityNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Models\ActivationCode;
use Models\User;

trait TwoFactorSecurity
{

    /**
     * Set two factor security code
     * @param \Model\User $user
     */
    public function set(User $user)
    {
        if (!$user->two_factor_enabled) {
            return;
        }
        \request()->session()->put('auth', [
            'email' => $user->email,
            'remember' => \request()->has('remember')
        ]);
        $code = ActivationCode::generateCode($user);
        if ($user->two_factor_type == 'sms') {
            $user->notify(new SmsActivationCodeNotification($code->code));
        }
        if ($user->two_factor_type == 'email') {
            $user->notify(new TwoFactorSecurityNotification($code->code));
        }
    }

    /**
     * Validate two factor security code
     * @param User $user
     * @param string $two_factor_code
     */
    public function validateCache($user, $two_factor_code): void
    {
        if (!config('config.auth.two_factor_security')) {
            return;
        }

        if (!\Cache::has('two_factor_security_' . $user->id)) {
            throw ValidationException::withMessages(['two_factor_code' => __('auth.security.invalid_code')]);
        }

        if (\Cache::get('two_factor_security_' . $user->id) != $two_factor_code) {
            throw ValidationException::withMessages(['two_factor_code' => __('auth.security.invalid_code')]);
        }

        $this->reset($user);
    }

    /**
     * Reset two factor security code
     * @param User $user
     */
    public function reset($user): void
    {
        \Cache::forget('two_factor_security_' . $user->id);
        session()->forget('2fa');
    }
}
