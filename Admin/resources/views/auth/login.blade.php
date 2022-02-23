@extends('auth.master')
@section('auth')
    <div class="card">
        <div class="card-body p-0 auth-header-box">
            <div class="text-center p-3">
                <a href="#" class="logo logo-admin">
                    <img src="{{asset('assets/images/logo-sm.png')}}" height="50" alt="logo" class="auth-logo">
                </a>
                <h4 class="mt-3 mb-1 fw-semibold text-white font-18">برهان ایمن</h4>
                <p class="text-muted  mb-0"> وارد شوید.</p>
            </div>
        </div>
        <div class="card-body pt-0">
            <form class="my-4" method="POST" action="{{route('login')}}">
                @csrf
                <div class="form-group mb-2">
                    <label class="form-label" for="username">نام کاربری</label>
                    <input type="text" class="form-control" id="username" name="email" placeholder="نام کاربری را وارد کنید">
                </div><!--end form-group-->

                <div class="form-group">
                    <label class="form-label" for="password"> رمز عبور</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder = "رمز عبور را وارد کنید">
                </div><!--end form-group-->

                <div class="form-group row mt-3">
                    <div class="col-sm-6">
                        <div class="form-check form-switch form-switch-success">
                            <input class="form-check-input" type="checkbox" id="customSwitchSuccess" name="remember">
                            <label class="form-check-label" for="customSwitchSuccess">من را به خاطر بسپار</label>
                        </div>
                    </div><!--end col-->
                    <div class="col-sm-6 text-end">
                        <a href="{{route('recover.get')}}" class="text-muted font-13"><i class="dripicons-lock"></i> رمز عبور را فراموش کرده اید؟</a>
                    </div><!--end col-->
                </div><!--end form-group-->

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary" type="submit">ورود به سیستم <i class="fas fa-sign-in-alt ms-1"></i></button>
                        </div>
                    </div><!--end col-->
                </div> <!--end form-group-->
            </form><!--end form-->

        </div>
    </div>
@endsection
