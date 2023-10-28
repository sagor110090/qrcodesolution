<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('event.create');

?>


<x-layouts.frontend>

    @volt('my-qrcode.create')
    <div class="relative flex flex-col items-center justify-center w-full h-auto overflow-hidden" x-cloak>
        <div class="h-full mx-auto max-w-7xl sm:px-6 lg:px-8 mt-20 bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden p-6">
            <x-step>


            </x-step>
        </div>
    </div>
    @endvolt
</x-layouts.frontend>
