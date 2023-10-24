<?php

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state,usesPagination,with};

name('my-qrcode.dynamic');
middleware(['auth', 'verified']);
usesPagination();


with('qrcodes', function() {
    return auth()->user()->qrcodes()->isdynamic()->latest()->paginate(10);
});

state('showModal', false);

$edit = function ($id) {
    return redirect()->route('my-qrcode.edit',['qrCode' => $id]);
};

$delete = function ($id) {
    $qrcode = auth()->user()->qrcodes()->findOrFail($id);
    $qrcode->delete();
    $this->dispatch('toast', message: 'Successfully deleted qrcode.', data: [ 'position' => 'top-right', 'type' => 'success' ]);
};


$makeDynamic = function ($id) {
    $qrcode = auth()->user()->qrcodes()->findOrFail($id);
    $qrcode->update(['is_dynamic' => true]);
    $this->dispatch('toast', message: 'Successfully updated qrcode.', data: [ 'position' => 'top-right', 'type' => 'success' ]);
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
            <div class="relative min-h-[500px] w-full h-full">

                @forelse ($qrcodes as $qrcode)
                <x-tw.card class="h-full mt-4">

                    <div class="grid grid-cols-12 gap-4" x-data="{ imageType: '', qrcodePreview: '',download(imageType) {
                        if (imageType === 'svg') {
                            let svg = document.querySelector('#qrcodePreview svg');
                            let data = new XMLSerializer().serializeToString(svg);
                            let downloadLink = document.createElement('a');
                            downloadLink.download = 'qrcode.' + imageType;
                            downloadLink.href = 'data:image/svg+xml;base64,' + btoa(data);
                            downloadLink.click();
                        } else if (imageType === 'png') {
                            let svg = document.querySelector('#qrcodePreview svg');
                            let canvas = document.createElement('canvas');
                            let ctx = canvas.getContext('2d');
                            let data = new XMLSerializer().serializeToString(svg);
                            let img = new Image();

                            img.onload = function () {
                                ctx.drawImage(img, 0, 0);
                                let downloadLink = document.createElement('a');
                                downloadLink.download = 'qrcode.png';
                                downloadLink.href = canvas.toDataURL('image/png;base64');
                                downloadLink.click();
                            };
                            let height = parseInt(svg.getAttribute('height'));
                            let width = parseInt(svg.getAttribute('width'));
                            img.setAttribute('src', 'data:image/svg+xml;base64,' + btoa(data));
                            canvas.setAttribute('height', height);
                            canvas.setAttribute('width', width);

                        } else if (imageType === 'jpeg') {
                            let svg = document.querySelector('#qrcodePreview svg');
                            let canvas = document.createElement('canvas');
                            let ctx = canvas.getContext('2d');
                            let data = new XMLSerializer().serializeToString(svg);
                            let img = new Image();

                            img.onload = function () {
                                ctx.drawImage(img, 0, 0);
                                let downloadLink = document.createElement('a');
                                downloadLink.download = 'qrcode.jpeg';
                                downloadLink.href = canvas.toDataURL('image/jpeg;base64');
                                downloadLink.click();
                            };
                            let height = parseInt(svg.getAttribute('height'));
                            let width = parseInt(svg.getAttribute('width'));
                            img.setAttribute('src', 'data:image/svg+xml;base64,' + btoa(data));
                            canvas.setAttribute('height', height);
                            canvas.setAttribute('width', width);
                        }
                        imageType = '';


                        } }">

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
                                    <div class="grid grid-cols-3 gap-4 p-2 ">
                                        <div class="cursor-pointer" @click="download('png')">
                                            <div
                                                class="border flex items-center justify-center bg-gradient-to-br rounded-lg p-2   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100 ">
                                                PNG
                                            </div>
                                        </div>
                                        <div class="cursor-pointer" @click="download('jpeg')">
                                            <div
                                                class="border flex items-center justify-center bg-gradient-to-br rounded-lg p-2 from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
                                                JPEG
                                            </div>
                                        </div>
                                        <div class="cursor-pointer" @click="download('svg')">
                                            <div
                                                class="border flex items-center justify-center bg-gradient-to-br rounded-lg p-2 from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
                                                SVG
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 border-l  border-gray-200 dark:border-gray-700">
                            <div class="p-2 grid  justify-start items-center mt-2 ml-2">
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $qrcode->name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                    {{ $qrcode->type }} QR Code
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Created at {{ $qrcode->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-3 border-l border-gray-200 dark:border-gray-700">

                            <div class="grid grid-cols-2 gap-2 p-2 justify-end items-center">
                                <x-ui.button type="primary"
                                    wire:click="edit({{$qrcode->id}})" size="md"
                                    submit="false">
                                    Edit
                                </x-ui.button>
                                <x-ui.button type="danger" wire:click="delete({{ $qrcode->id }})" size="md"
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
