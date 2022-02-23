<?php

namespace App\Repository\Auth;

use App\Helpers\Constants;
use Illuminate\Support\Facades\Auth;
use \Models\User;
use App\Http\Resources\AuthUser;
use App\Traits\TwoFactorSecurity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;

class LoginRepository
{
    use TwoFactorSecurity;

    protected $user;

    /**
     * Instantiate a new instance
     * @return void
     */
    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    /**
     * Authenticate user
     */
    public function login()
    {
        if ($this->validateLogin() instanceof User){
            $user = $this->validateLogin();
            $this->set($user);
            return $user;
        }

        else {
            return back()->with('errors', Constants::INVALID_CREDENTIALS);
        }
    }

    /**
     * Validate login credentials
     */
    public function validateLogin()
    {
        if (filter_var(request('email'), FILTER_VALIDATE_EMAIL)) {
            $credentials = array('email' => request('email'), 'password' => request('password'));
        } else {
            $credentials = array('username' => request('email'), 'password' => request('password'));
        }
        if (! \Auth::attempt($credentials)) {
            return back()->with('errors', Constants::INVALID_CREDENTIALS);

        }
        return \Auth::user();
    }

    /**
     * Validate device login credentials
     */
    public function validateDeviceLogin() : User
    {
        if (filter_var(request('email'), FILTER_VALIDATE_EMAIL)) {
            $user = User::whereEmail(request('email'))->first();
        } else {
            $user = User::whereUsername(request('email'))->first();
        }

        if (! $user || ! Hash::check(request('password'), $user->password)) {
            $this->throttleUpdate();
            return back()->withErrors(['email'=>Constants::INVALID_CREDENTIALS]);
            throw ValidationException::withMessages(['email'=>Constants::INVALID_CREDENTIALS]);
        }

        return $user;
    }


    public function logout()
    {
        Auth::guard()->logout();
    }

}
