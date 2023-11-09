<?php

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, usesPagination, with, on,uses};
use Jantinnerezo\LivewireAlert\LivewireAlert;

name('my-qrcode.dynamic');
middleware(['auth', 'verified']);
usesPagination();
uses(LivewireAlert::class);

on([
    'updateQrCode' => function () {
        // refresh
    },
]);

with('qrcodes', function () {
    return auth()
        ->user()
        ->qrCodes()
        ->isdynamic()
        ->with('qrCodeTracks')
        ->latest()
        ->paginate(10);
});

state([
    'showModal' => false,
    'locations' => null,
]);





$makeStatic = function ($id) {
    $qrcode = auth()
        ->user()
        ->qrCodes()
        ->findOrFail($id);
    $qrcode->update(['is_dynamic' => false]);
    $this->alert('success', 'Successfully updated qrcode.');

};

$status = function ($id, $status = false) {
    if(auth()->user()->isNotOnSubscription() && !$status) {
        $this->dispatch('openModal', component:'my-qrcode.subscription-alert', arguments: ['qrcodeId' => $id]);
        return;
    }
    // if (auth()->user()
    $qrcode = auth()
        ->user()
        ->qrCodes()
        ->findOrFail($id);
    $qrcode->update(['status' => !$qrcode->status]);
    $this->alert('success', 'Successfully updated qrcode.');

};

?>

<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dynamic QR Code') }}
        </h2>
    </x-slot>

    @volt('my-qrcodes.dynamic')
        <div class="h-full py-12">
            <div class="h-full mx-auto max-w-7xl sm:px-6 lg:px-8">
               <x-qrcode.subscription-alert />

                <div class="relative min-h-[500px] w-full h-full">

                    @forelse ($qrcodes as $qrcode)
                        <x-tw.card class="h-full mt-4 ">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="flex items-end justify-end col-span-12 md:col-span-3 md:hidden">
                                    @if (!$qrcode->status)
                                        <x-button.circle negative icon="x" wire:click="status({{ $qrcode->id }},{{$qrcode->status}})" title="Inactive" />
                                    @else
                                        <x-button.circle positive icon="check" wire:click="status({{ $qrcode->id }},{{$qrcode->status}})" title="Active" />
                                    @endif
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <div class="p-0 grid  justify-center">
                                        <div class=" max-w-[18rem] rounded-lgdark:bg-neutral-700 grid justify-items-center">
                                            <div class="relative overflow-hidden bg-cover bg-no-repeat">

                                                <div class="border-2 shadow-sm rounded-lg">
                                                    <div id="qrcodePreview">
                                                        {!! $qrcode->dynamic_qr_code_svg !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <x-qrcode.qr-download-btn />
                                        </div>

                                    </div>
                                </div>

                                <div class="col-span-12 md:col-span-6 border-l  border-gray-200 dark:border-gray-700">
                                    <div class="p-1 grid  justify-start items-center mt-2 ml-2">
                                        <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {{ $qrcode->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                            {{ $qrcode->type }} QR Code
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            Created at {{ $qrcode->created_at->format('d M Y') }}
                                        </div>
                                        <div class="flex items-end justify-start mt-4">
                                            <div>
                                                <x-ui.button type="info" size="md"
                                                    wire:click="$dispatch('openModal', { component: 'my-qrcode.custom-link', arguments: { qrcode: {{ $qrcode }} }})"
                                                    submit="false">
                                                    Custom Link
                                                </x-ui.button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center mt-4">
                                        <div class="ml-2">
                                            <p class="text-md text-gray-600 dark:text-gray-200">
                                                <span class="font-bold">{{ $qrcode->scan_count }}</span> Scans
                                            </p>
                                            <div class="mt-2">
                                                <x-ui.button type="info" size="md"
                                                    wire:click="$dispatch('openModal', { component: 'my-qrcode.track', arguments: { locations: {{ $qrcode->qrCodeTracks }} }})"
                                                    submit="false">
                                                    Track
                                                </x-ui.button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-12 md:col-span-3 border-l border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center justify-end mb-2 invisible md:visible">
                                        @if (!$qrcode->status)
                                            <x-button.circle negative icon="x" wire:click="status({{ $qrcode->id }},{{$qrcode->status}})" title="Inactive" />
                                        @else
                                            <x-button.circle positive icon="check" wire:click="status({{ $qrcode->id }},{{$qrcode->status}})" title="Active" />
                                        @endif
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 p-2 justify-end items-center">
                                        <x-ui.button type="primary" tag="a" href="{{route('my-qrcode.edit', ['qrCode' => $qrcode])}}" size="md" wire:navigate>
                                            Edit
                                        </x-ui.button>
                                        <x-ui.button type="danger" wire:click="$dispatch('openModal', { component: 'my-qrcode.delete-alert', arguments: { id: {{ $qrcode->id }} }})" size="md"
                                            submit="false">
                                            Delete
                                        </x-ui.button>
                                    </div>

                                    <div>
                                    </div>
                                    @if (!Support::onlyDynamic($qrcode->type))
                                        <div class="p-2 mt-10 border-t border-b border-gray-200 dark:border-gray-700">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                If you want to make this QR Code static, click the button below.
                                            </p>
                                            <div class="mt-2">

                                                <x-ui.button type="info" wire:click="makeStatic({{ $qrcode->id }})"
                                                    size="md" submit="false">
                                                    Make Static
                                                </x-ui.button>
                                            </div>


                                        </div>
                                    @endif



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
            <x-ui.modal :show="$showModal" name="Track">
                <div>
                    <h1>
                        test
                    </h1>
                </div>
            </x-ui.modal>

        </div>
    @endvolt

    @push('css')
        <style>
            svg.qrcodesvg {
                height: 157px;
                width: 157px;
            }
        </style>
    @endpush

</x-layouts.app>
