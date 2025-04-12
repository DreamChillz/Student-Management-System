<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <!-- Include your CSS files here. For example: Bootstrap, Tailwind, etc. -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <!-- sidebar -->
        @include('sidebar')

        <!-- main content -->
        <div class="main-content">
            <div class="container py-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>