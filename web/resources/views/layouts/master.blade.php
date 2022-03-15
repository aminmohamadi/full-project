<!DOCTYPE html>
<html dir="ltr" lang="en">
@include('layouts.partials.header')


<body>
<div class="wrapper">

    <!-- navigation -->
@include('layouts.partials.navigation')
@yield('content')
@include('layouts.partials.footer')

@include('layouts.partials.js')
<!-- Our footer -->
</div>

</body>
</html>
