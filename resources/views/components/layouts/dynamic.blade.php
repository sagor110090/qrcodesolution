<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @stack('css')

    {{ $title ?? '' }}
</head>

<body class="min-h-screen antialiased bg-slate-100 " >
    {{ $slot }}

    @stack('js')
</body>

</html>

