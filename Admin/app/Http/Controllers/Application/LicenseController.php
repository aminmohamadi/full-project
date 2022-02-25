<?php

namespace App\Http\Controllers;

use App\License;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Middleware\RedirectIfShouldNotCreateLicense;

class LicenseController extends Controller
{
    public function __construct()
    {
//        $this->middleware(RedirectIfShouldNotCreateLicense::class);
    }

    public function create()
    {
        return view('install.license');
    }

    public function store(License $license)
    {
        request()->validate([
            'purchase_code' => 'required',
        ]);

        $license->activate(request('purchase_code'));

        if (env('INSTALLED' == true)){
            return redirect()->intended('/dashboard');

        }
        return redirect()->intended('/install/configuration');
    }

    public function check(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'valid' => true,
            'purchase_code' => $request->purchase_code
        ]);
    }
}
