@extends('auth.master')

@section('auth')
    <div class="card">
        <div class="card-body p-0 auth-header-box">
            <div class="text-center p-3">
                <a href="index-2.html" class="logo logo-admin">
                    <img src="assets/images/logo-sm.png" height="50" alt="logo" class="auth-logo">
                </a>
                <h4 class="mt-3 mb-1 fw-semibold text-white font-18"> رمز عبور را وارد کنید و از یونیکت  استفاده کنید</h4>
                <p class="text-muted  mb-0">سلام پریسا، رمز عبور خود را برای باز کردن قفل صفحه وارد کنید!</p>
            </div>
        </div>
        <div class="card-body pt-0">
            <form class="my-4" action="https://digi-root.ir/Unikit_RTL/index.html">
                <div class="form-group mb-3">
                    <label class="form-label" for="userpassword"> رمز عبور</label>
                    <input type="password" class="form-control" name="password" id="userpassword" placeholder = "رمز عبور را وارد کنید">
                </div><!--end form-group-->

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="button">باز کردن قفل <i class="fas fa-sign-in-alt ms-1"></i></button>
                    </div><!--end col-->
                </div> <!--end form-group-->
            </form><!--end form-->
            <div class="text-center text-muted">
                <p class="mb-1"> تو نیستی؟ بازگشت <a href="auth-register.html" class="text-primary ms-2">اینجا وارد شوید</a></p>
            </div>
        </div><!--end card-body-->
        <div class="card-body bg-light-alt text-center">
            &copy; <script>
                document.write(new Date().getFullYear())
            </script> یونیکت
        </div>
    </div>
@endsection
