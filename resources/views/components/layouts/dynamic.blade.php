<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,301,300,400&display=swap" rel="stylesheet">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;700&family=Fredoka:wght@400;700&family=Lora:wght@400;700&family=Montserrat:wght@400;700&family=Roboto:wght@400;700&family=Rubik:wght@400;700&family=Unbounded:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@400;700&family=Domine:wght@400;700&family=Merriweather:wght@400;700&family=Nunito:wght@400;700&family=Oswald:wght@400;700&family=Poppins:wght@400;700&family=Raleway:wght@400;700&family=Teko:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @stack('css')

    {{ $title ?? '' }}
</head>

<body class="min-h-screen antialiased bg-slate-100 " >
    {{ $slot }}

    @stack('js')
</body>

</html>
