<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ArrHelper;
use App\Helpers\Constants;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function me()
    {
        $user = Auth::user();
        return view('authentication.profile',compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update([
           'first_name'=>$request->first_name,
           'last_name'=>$request->last_name,
           'email'=>$request->email,
           'phone'=>$request->phone,
           'gender'=>$request->gender,
           'national_code'=>$request->national_code,
        ]);
        toast(Constants::SUCCESS_OPERATION_MESSAGE ,'success');
        return back();
    }

    public function uploadAvatar()
    {
        request()->validate([
            'image' => 'required|image'
        ]);
        $user = Auth::user();

        if ($user->avatar && \Storage::disk('public/avatars')->exists($user->image)) {
            \Storage::disk('public')->delete('avatars/'.$user->avatar);
        }
        $file = Helpers::upload('avatars/',\request()->file('image'));
        $user->image = $file;
        $user->save();
        return response()->json(['status'=>'success','data'=>Constants::SUCCESS_OPERATION_MESSAGE]);
    }

    public function removeAvatar()
    {
        $user = Auth::user();

        if (! $user->image) {
            return;
        }

        if (\Storage::disk('public')->exists('avatars/'.$user->image)) {
            \Storage::disk('public')->delete('avatars/'.$user->image);
        }
        $user->image = null;
        $user->save();
        return response()->json(['status'=>'success','data'=>Constants::SUCCESS_OPERATION_MESSAGE]);
    }
}
