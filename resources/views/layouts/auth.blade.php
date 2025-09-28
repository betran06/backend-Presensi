<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Auth') | Presensi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Logo & Favicon -->
    <!-- <link rel="shortcut icon" href="{{ asset('assets/image/logo-itplus.svg') }}"> -->

    <!-- Bootstrap (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>

    <!-- App CSS via Vite -->
     <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<body class="authentication-bg">
    <div class="account-pages">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
