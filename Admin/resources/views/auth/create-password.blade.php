@extends('auth.master')

@section('auth')
    <div class="card">
        <div class="card-body p-0 auth-header-box">
            <div class="text-center p-3">
                <a href="#" class="logo logo-admin">
                    <img src="{{asset('assets/images/logo-sm.png')}}" height="50" alt="logo" class="auth-logo">
                </a>
                <h4 class="mt-3 mb-1 fw-semibold text-white font-18">بازنشانی رمز عبور</h4>
                <p class="text-muted  mb-0">کد ارسال شده به ایمیلتان را وارد کنید</p>
            </div>
        </div>
        <div class="card-body pt-0">
            <form class="my-4" action="{{route('password.validate')}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label" for="email">ایمیل</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="ایمیل را وارد کنید">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="code">کد ارسال شده</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="کد ارسال شده را وارد کنید">
                </div><!--end form-group-->
                <div class="form-group mb-3">
                    <label class="form-label" for="password">رمز جدید</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="رمز جدید را وارد کنید">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="password_confirmation">تکرار رمز جدید</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="تکرار رمز جدید">
                </div>
                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">بازنشانی <i class="fas fa-sign-in-alt ms-1"></i></button>
                    </div><!--end col-->
                </div> <!--end form-group-->
            </form><!--end form-->
            <div class="text-center text-muted">
                <p class="mb-1"> آن را به خاطر می آورید؟ <a href="{{route('login')}}" class="text-primary ms-2">اینجا وارد شوید</a></p>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
@endsection
