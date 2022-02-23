<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TwoFactorSecurityRequest;

class TwoFactorSecurity extends Controller
{

    protected $request;

    /**
     * Instantiate a new controller instance
     * @return void
     */
    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }


    public function challenge()
    {
        return view('authentication.2fa');
    }
//
//    /**
//     * Validate two factor security
//     * @post ("/api/auth/security")
//     * @param ({
//     *      @Parameter("two_factor_code", type="integer", required="true", description="Two factor code"),
//     * })
//     * @return array
//     */
//    public function __invoke(TwoFactorSecurityRequest $request)
//    {
//        $this->validateCache(\Auth::user(), request('two_factor_code'));
//
//        return $this->ok([]);
//    }
}
