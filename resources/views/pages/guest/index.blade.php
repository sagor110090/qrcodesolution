<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;


name('home');


?>

<x-layouts.frontend>

    @volt('home')
    <div class="relative flex flex-col items-center justify-center w-full h-auto overflow-hidden">
        <x-ui.icons.qrcode
            class="absolute top-0 left-0 w-7/12 -ml-40 -translate-x-1/2 fill-current opacity-10 dark:opacity-5 text-slate-400" />
        <x-ui.icons.qrcode
            class="absolute top-0 right-0 w-7/12 -mr-40 translate-x-1/2 fill-current opacity-10 dark:opacity-5 text-slate-400" />


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
