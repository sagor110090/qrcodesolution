<?php

use function Laravel\Folio\{middleware, name};
//use function Livewire\Volt\{state};

name('dashboard');
middleware(['auth', 'verified']);

?>

<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @volt('dashboard')
    <div class="h-full py-12">

        <div class="h-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-qrcode.subscription-alert />
            <div class="relative min-h-[500px] w-full h-full">
                <div class="container flex flex-col mx-auto rounded-3xl shadow-main ">
                    <div class="grid w-full grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                        <div class="flex flex-col items-center gap-3 px-8 py-10 bg-white shadow  dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                            <span class="flex items-center justify-center w-16 h-16">
                                <i class="bi bi bi-activity text-4xl text-dark-grey-900 text-blue-500"></i>
                            </span>
                            <p class="text-2xl font-bold text-center text-dark-grey-900 dark:text-white">
                                {{ auth()->user()->qrcodes()->count() }}
                            </p>
                            <p class="text-sm font-medium text-center text-dark-grey-900 dark:text-white">
                                Total QR Codes
                            </p>
                        </div>
                        <div class="flex flex-col items-center gap-3 px-8 py-10 bg-white shadow  dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                            <span class="flex items-center justify-center w-16 h-16">
                                <i class="bi bi bi-activity text-4xl text-dark-grey-900 text-blue-500"></i>
                            </span>
                            <p class="text-2xl font-bold text-center text-dark-grey-900 dark:text-white">
                                {{ auth()->user()->qrcodes()->isStatic()->count() }}
                            </p>
                            <p class="text-sm font-medium text-center text-dark-grey-900 dark:text-white">
                                Total Static QR Codes
                            </p>
                        </div>
                        <div class="flex flex-col items-center gap-3 px-8 py-10 bg-white shadow  dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                            <span class="flex items-center justify-center w-16 h-16">
                                <i class="bi bi bi-activity text-4xl text-dark-grey-900 text-blue-500"></i>
                            </span>
                            <p class="text-2xl font-bold text-center text-dark-grey-900 dark:text-white">
                                {{ auth()->user()->qrcodes()->isDynamic()->count() }}
                            </p>
                            <p class="text-sm font-medium text-center text-dark-grey-900 dark:text-white">
                                Total Dynamic QR Codes
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endvolt
</x-layouts.app>
