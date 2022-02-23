<!DOCTYPE html>
<html lang="en" dir="rtl">
@include('layouts.partials.header')

<body id="body" class="auth-page"
      style="background-image: url('{{asset('assets/images/p-1.png')}}'); background-size: cover; background-position: center center;">
<!-- Log In page -->
<div class="container">
    <div class="row vh-100 d-flex justify-content-center">
        <div class="col-12 align-self-center">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    @yield('auth')
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end col-->
    </div><!--end row-->
</div><!--end container-->
@include('sweetalert::alert')
@include('layouts.partials.footer')
</body>


</html>
