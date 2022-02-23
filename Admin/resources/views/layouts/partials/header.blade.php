<head>
    <meta charset="utf-8" />
    <title>قالب مدیریت</title>
    <meta content="Amin Mohamadi" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf-token"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- App css -->
    @include('layouts.partials.css')

</head>
