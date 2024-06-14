<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ $seo ?? '' }}
    <!-- Used to add dark mode right away, adding here prevents any flicker -->
    <script>
        if (typeof(Storage) !== "undefined") {
            if (localStorage.getItem('dark_mode') && localStorage.getItem('dark_mode') == 'true') {
                document.documentElement.classList.add('dark');
            }
        }
        //for first time load page follow the system mode
        if (typeof(Storage) !== "undefined") {
            if (!localStorage.getItem('dark_mode')) {
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                }
            }
        }
    </script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <wireui:scripts />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QMKKRSPV2Q"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-QMKKRSPV2Q');
    </script>


    @stack('css')
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" sizes="16x16">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4513982418525408"
    crossorigin="anonymous"></script>
</head>

<body class="min-h-screen antialiased bg-slate-100 dark:bg-gradient-to-b dark:from-gray-950 dark:to-gray-900" x-data="loader">


        {{ $slot }}


    @stack('js')

    @livewire('wire-elements-modal')


    @persist('chat')
    <script type="text/javascript" src="https://talklayerai.com/cdn?key=9bf009d6-3706-41d9-823e-310b9a6f6f1b"></script>
    <script type="text/javascript" src="https://visitor-track.mehedihasansagor.com/cdn?key=9c48f521-1a71-4ce2-af61-b3c761ed7ca9"></script>
    @endpersist
</body>

</html>
