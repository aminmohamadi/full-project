<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repository\Auth\LoginRepository;
use Illuminate\Support\Facades\Auth;
use Models\User;

class LoginController extends Controller
{
    protected $repo;

    /**
     * Instantiate a new controller instance
     * @return void
     */
    public function __construct(
        LoginRepository $repo
    ) {
        $this->repo = $repo;
    }

    public function login(LoginRequest $request)
    {
        if ($this->repo->login() instanceof User) {
            $user = $this->repo->login();
            if ($user->two_factor_enabled) {
                Auth::logout();
                return redirect()->route('two_factor_auth_get');
            }
            toast(Constants::WELCOME_MESSAGE,'success');
            return redirect()->route('home');

        }
        else{
            toast(Constants::INVALID_CREDENTIALS,'error');
            return redirect('login');

        }
    }



    public function loginForm()
    {
        return view('auth.login');
    }


    public function logout()
    {
        $this->repo->logout();
        return redirect()->route('login.get');

    }
}
