<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Constants;
use App\Notifications\ResetPassword;
use App\Notifications\ResetPasswordEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordEmailRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Models\User;

class ResetPasswordController extends Controller
{
    protected $request;

    /**
     * Instantiate a new controller instance
     * @return void
     */
    public function __construct(
        Request $request,
        User $user
    )
    {
        $this->request = $request;
        $this->user = $user;

    }

    public function index()
    {
        return view('auth.recover');
    }

    public function password(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'code'  => 'sometimes|required'
        ]);
        if ($validator->fails()){
            toast($validator->errors()->first(),'error');
            return back();
        }
        if ($this->getUser() instanceof User){
            $user = $this->getUser();

            $code = rand(100000, 999999);

            DB::table('password_resets')->insert([
                'email' => request('email'),
                'token' => $code,
                'created_at' => now()
            ]);

            $user->notify(new ResetPasswordEmail($user, $code));
            toast(Constants::IF_EMAIL_EXIST_WE_SEND_TOKEN,'success');
            return redirect()->route('recover.code');
        }else{
            toast(Constants::IF_EMAIL_EXIST_WE_SEND_TOKEN,'success');
            return redirect()->route('recover.code');
        }

    }

    public function code()
    {
        return view('auth.create-password');
    }
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'code'  => 'required|min:6|max:6',
            'password' => 'required|confirmed'
        ]);
        if ($validator->fails()){
            toast($validator->errors()->first(),'error');
            return back();
        }

        if ($this->getUser() instanceof User){
            $user = $this->getUser();
            $validate = $this->validateData();;
            $user->password = bcrypt(request('password'));
            $user->save();

            DB::table('password_resets')->where('email', '=', $request->email)->where('token', '=', $request->code)->delete();

            $user->notify(new ResetPassword($user));
            return redirect()->route('login');

        }
        toast(Constants::IF_EMAIL_EXIST_WE_SEND_TOKEN,'success');
        return back();
    }
    /**
     * Validate reset password code
     */
    public function validateData()
    {
        $reset = DB::table('password_resets')->where('email', '=', request('email'))->where('token', '=', request('code'))->first();

        if (! $reset) {
            toast(Constants::IF_EMAIL_EXIST_WE_SEND_TOKEN,'success');
            return back();
        }
    }

    private function getUser()
    {
        $user = $this->user->whereEmail(request('email'), 1)->first();

        if (!$user) {
            return;
        }

        return $user;
    }
}
