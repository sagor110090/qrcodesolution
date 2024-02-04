<?php

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, usesPagination, with, on,uses};

name('my-qrcode.static');
middleware(['auth', 'verified']);
usesPagination();

on([
    'updateQrCode' => function () {
        // refresh
    },
]);

with('qrcodes', function() {
    return auth()->user()->qrCodes()->isStatic()->latest()->paginate(10);
});

state('showModal', false);



$delete = function ($id) {
    $qrcode = auth()->user()->qrCodes()->findOrFail($id);
    $qrcode->delete();
    $this->dispatch('toast', message: 'Successfully deleted qrcode.', data: [ 'position' => 'top-right', 'type' => 'success' ]);
};


$makeDynamic = function ($id) {
    $qrcode = auth()->user()->qrCodes()->findOrFail($id);
    $qrcode->update(['is_dynamic' => true]);
    $this->dispatch('toast', message: 'Successfully updated qrcode.', data: [ 'position' => 'top-right', 'type' => 'success' ]);
};




?>

<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Static QR Codes') }}
        </h2>
    </x-slot>

    @volt('my-qrcodes.static')
    <div class="h-full py-12">
        <div class="h-full mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-qrcode.subscription-alert />
            <div class="relative min-h-[500px] w-full h-full">

                @forelse ($qrcodes as $qrcode)
                <x-tw.card class="h-full mt-4">

                    <div class="grid grid-cols-12 gap-4">

                        <div class="col-span-12 md:col-span-3">
                            <div class="grid justify-center p-0">
                                <div class=" max-w-[18rem] rounded-lgdark:bg-neutral-700 grid justify-items-center">
                                    <div class="relative overflow-hidden bg-no-repeat bg-cover">

                                        <div class="border-2 rounded-lg shadow-sm">
                                            <div id="qrcodePreview">
                                                {!! Support::getQrCodeSvg($qrcode) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <x-qrcode.qr-download-btn />
                                </div>

                            </div>
                        </div>

                        <div class="col-span-12 border-l border-gray-200 md:col-span-6 dark:border-gray-700">
                            <div class="grid items-center justify-start p-2 mt-2 ml-2">
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $qrcode->name }}
                                </div>
                                <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    {{ Str::ucfirst($qrcode->type) }} QR Code
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Created at {{ $qrcode->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 border-l border-gray-200 md:col-span-3 dark:border-gray-700">

                            <div class="grid items-center justify-end grid-cols-2 gap-2 p-2">
                                <x-ui.button type="primary" tag="a" href="{{route('my-qrcode.edit', ['qrCode' => $qrcode])}}" size="md" wire:navigate>
                                    Edit
                                </x-ui.button>
                                <x-ui.button type="danger" wire:click="$dispatch('openModal', { component: 'my-qrcode.delete-alert', arguments: { id: {{ $qrcode->id }} }})" size="md"
                                    submit="false">
                                    Delete
                                </x-ui.button>
                            </div>

                            <div class="p-2 mt-10 border-t border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    For track your qrcode you can update your qrcode to dynamic qrcode.
                                </p>
                                <div class="mt-2">
                                    <x-ui.button type="info" wire:click="makeDynamic({{ $qrcode->id }})" size="md"
                                        submit="false">
                                        Update to Dynamic
                                    </x-ui.button>
                                </div>


                            </div>



                        </div>
                    </div>
                </x-tw.card>
                @empty
                <x-ui.placeholder />
                @endforelse
            </div>
            <div class="mt-4">
                {{ $qrcodes->links() }}
            </div>
        </div>
    </div>
    @assets
    <style>

           </style>
     @endassets
    @endvolt



</x-layouts.app>
