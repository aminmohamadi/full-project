<!DOCTYPE html>
<html lang="en" dir="rtl">
@include('layouts.partials.header')

<body  id="body" class="dark-sidebar">
@include('layouts.partials.sidebar')
@include('layouts.partials.toolbar')
<div class="page-wrapper">
    <div class="page-content-tab">

        <div class="container-fluid">
            @yield('content')
        </div>
        @include('sweetalert::alert')

        @if ($errors->any())
            @foreach($errors->all() as $error)
                <?php
                toast($error , 'error')
                ?>
            @endforeach
        @endif

    @include('layouts.partials.footer')
    </div>
</div>
@include('layouts.partials.js')
</body>
</html>
