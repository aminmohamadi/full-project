<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginWithOtpRequest;
use App\Repository\Auth\LoginWithOtpRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Models\User;

class LoginWithOtp extends Controller
{
    protected $repo;

    /**
     * Instantiate a new controller instance
     * @return void
     */
    public function __construct(
        LoginWithOtpRepository $repo
    )
    {
        $this->repo = $repo;

//        $this->middleware('otp_login:email');
    }


    public function challenge()
    {
        return view('auth.otp');
    }


    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'otp' => 'sometimes',
            'email' => 'required|email',
        ]);
        if ($validation->fails()) {
            $request->session()->reflash();
            toast($validation->errors()->first(), 'error');
            return back();
        }
        $user = $this->repo->login();
        Auth::guard()->login($user);

        return redirect()->route('home');


    }


    public function regenerate()
    {
        $user = User::whereEmail(request('email'))->first();
        $this->repo->regenerate($user);
        toast('کد با موفقیت ارسال شد','success');
        return back();
    }
}
