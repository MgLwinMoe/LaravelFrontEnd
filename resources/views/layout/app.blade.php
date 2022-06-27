<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('inc.header')
</head>

<body>

    <div id="app">
        @include('inc.nav')
        @yield('maincontent')
    </div>
    @include('inc.footer')
</body>

</html>
