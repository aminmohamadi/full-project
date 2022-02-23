<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Repositories\Auth\ChangePasswordRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ChangePassword extends Controller
{
    public function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(),[
           'current_password'=>'required',
           'password' => 'required|min:8|max:20|confirmed'
        ]);
        if ($validator->fails()){
            toast($validator->errors()->first(),'error');
            return back();
        }
        $user = Auth::user();
        if (! Hash::check(request('current_password'), $user->password)) {
            toast(Constants::ERROR_OPERATION_MESSAGE,'error');
            return back();        }
        $user->password = Hash::make(request('password'));
        $user->save();
        toast(Constants::SUCCESS_OPERATION_MESSAGE,'success');
        return back();
    }

}
