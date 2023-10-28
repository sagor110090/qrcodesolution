<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Used to add dark mode right away, adding here prevents any flicker -->
    <script>
        if (typeof(Storage) !== "undefined") {
                if(localStorage.getItem('dark_mode') && localStorage.getItem('dark_mode') == 'true'){
                    document.documentElement.classList.add('dark');
                }
        }
         //for first time load page follow the system mode
         if (typeof(Storage) !== "undefined") {
            if(!localStorage.getItem('dark_mode')){
                if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches){
                    document.documentElement.classList.add('dark');
                }
            }
        }



    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('css')

    <title>{{ $title ?? config('app.name') }}</title>
    {{-- icon --}}
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" sizes="16x16">
</head>

<body class="min-h-screen antialiased bg-slate-100 dark:bg-gradient-to-b dark:from-gray-950 dark:to-gray-900" >
    {{ $slot }}
    <x-layouts.footer />
    @stack('js')
    <livewire:toast />
    @livewire('wire-elements-modal')
    <x-loader />
</body>

</html>
