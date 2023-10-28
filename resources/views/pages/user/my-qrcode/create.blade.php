
<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('my-qrcode.create');
middleware(['auth', 'verified']);

?>


<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create QR Code') }}
        </h2>
    </x-slot>

    @volt('my-qrcode.create')
        <div class="h-full py-12">
            <div class="h-full mx-auto max-w-7xl sm:px-6 lg:px-8">
                <livewire:my-qrcode.create />
            </div>
        </div>
    @endvolt
</x-layouts.app>
