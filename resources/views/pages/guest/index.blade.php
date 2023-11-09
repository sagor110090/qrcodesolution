<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;


name('home');


?>

<x-layouts.frontend>

    <x-slot name="seo">
        <title> Qr Code Solution | Free QR Code Generator, Coupon, Contact & Design QR Codes & Tracking | Qrcode Solution</title>
        <meta name="description" content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta name="author" content="Qrcode Solution">
        <meta name="robots" content="index,follow">
        <meta name="googlebot" content="index,follow">
        <meta name="google" content="notranslate">
        <meta name="generator" content="Qrcode Solution">
        <meta name="rating" content="general">
        <meta name="distribution" content="global">
        <meta name="subject" content="QR Code Solution">
        <meta name="url" content="https://qrcodesolution.com">
        <meta name="identifier-URL" content="https://qrcodesolution.com">
        <meta name="coverage" content="Worldwide">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- HTML Meta Tags --}}
        <title>Free QR Code Generator, Coupon, Contact & Design QR Codes & Tracking | Qrcode Solution</title>
        <meta name="description" content="Free QR Code Generator and online QR code creator. No sign-up required. Create unlimited non-expiring free QR codes for a website URL, YouTube video, Google Maps location, FaceBook link, contact details or any one of 22 QR code types.">
        <meta name="keywords" content="QR code, QR code generator, QR code creator, free QR code, QR code maker, QR code reader, QR code tracking, QR code analytics, QR code campaign, QR code marketing, QR code coupon, QR code vCard, QR code contact, QR code design">

        {{-- Google / Search Engine Tags --}}
        <meta itemprop="name" content="Free QR Code Generator, Coupon, Contact & Design QR Codes & Tracking | Qrcode Solution">
        <meta itemprop="description" content="Free QR Code Generator and online QR code creator. No sign-up required. Create unlimited non-expiring free QR codes for a website URL, YouTube video, Google Maps location, FaceBook link, contact details or any one of 22 QR code types.">
        <meta itemprop="image" content="https://qrcodesolution.com/images/logo.png">


        {{-- Facebook Meta Tags --}}
        <meta property="og:url" content="https://qrcodesolution.com">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Free QR Code Generator, Coupon, Contact & Design QR Codes & Tracking | Qrcode Solution">
        <meta property="og:description" content="Free QR Code Generator and online QR code creator. No sign-up required. Create unlimited non-expiring free QR codes for a website URL, YouTube video, Google Maps location, FaceBook link, contact details or any one of 22 QR code types.">
        <meta property="og:image" content="https://qrcodesolution.com/images/logo.png">

        {{-- Twitter Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Free QR Code Generator, Coupon, Contact & Design QR Codes & Tracking | Qrcode Solution">
        <meta name="twitter:description" content="Free QR Code Generator and online QR code creator. No sign-up required. Create unlimited non-expiring free QR codes for a website URL, YouTube video, Google Maps location, FaceBook link, contact details or any one of 22 QR code types.">
        <meta name="twitter:image" content="https://qrcodesolution.com/images/logo.png">
        <meta name="twitter:site" content="@qrcodesolution">
        <meta name="twitter:creator" content="@qrcodesolution">

    </x-slot>

    @volt('home')
    <div class="relative flex flex-col items-center justify-center w-full h-auto">
        {{-- <div class="relative flex flex-col items-center justify-center w-full h-auto overflow-hidden">
            <x-ui.icons.qrcode
                class="absolute top-0 left-0 w-7/12 -ml-40 -translate-x-1/2 fill-current opacity-10 dark:opacity-5 text-slate-400" />
            <x-ui.icons.qrcode
                class="absolute top-0 right-0 w-7/12 -mr-40 translate-x-1/2 fill-current opacity-10 dark:opacity-5 text-slate-400" />

        </div> --}}


        <div class="flex items-center w-full max-w-6xl mx-auto">
            <div class="container relative max-w-4xl mx-auto mt-20 text-center sm:mt-24 lg:mt-32">
                <div style="background-image:linear-gradient(160deg,#e66735,#e335e2 50%,#73f7f8, #a729ed)"
                    class="inline-block w-auto p-0.5 shadow rounded-full animate-gradient">
                    <p
                        class="w-auto h-full px-3 bg-slate-50 dark:bg-neutral-900 dark:text-white py-1.5 font-medium text-sm tracking-widest uppercase  rounded-full text-slate-800/90 group-hover:text-white/100">
                        Welcome to Qrcode Solution</p>
                </div>
                <h1
                    class="mt-5 text-4xl font-light leading-tight tracking-tight text-center dark:text-white text-slate-800 sm:text-5xl md:text-8xl">
                    Create QR Codes <br class="hidden md:block"> in seconds
                </h1>
                <p class="w-full max-w-2xl mx-auto mt-8 text-lg dark:text-white/60 text-slate-500">
                    Create QR Codes for free. No sign-up required. Create as many as you like.
                </p>
                @guest
                <div class="flex items-center justify-center w-full max-w-sm px-5 mx-auto mt-8 space-x-5">
                    <x-ui.button
                    tag="a"
                    href="{{ route('register') }}"
                    type="primary"
                    submit="false"
                    >Get Started</x-ui.button>
                </div>
                @endguest

            </div>
        </div>


        <div class="w-full max-w-6xl mx-auto">
            <livewire:my-qrcode.create />
        </div>





    </div>
    @endvolt

</x-layouts.frontend>
