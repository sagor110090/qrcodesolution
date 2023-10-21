<?php

    use function Laravel\Folio\{middleware, name};
    use function Livewire\Volt\{state, rules};

    name('admin.dashboard');


?>


<x-layouts.admin>
    @volt('admin.dashboard')
    <div>
        <x-slot name="header">
            {{ __('Dashboard') }}
    </x-slot>

    {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <livewire:chart.country-visitors />
        </div>
    </div> --}}
    {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
        <div class="p-6 border-b border-gray-200">
            <livewire:chart.monthly-visitors />
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
        <div class="p-6 border-b border-gray-200">
            <livewire:chart.daily-visitors />
        </div>
    </div> --}}
    </div>
    @endvolt
</x-layouts.admin>
