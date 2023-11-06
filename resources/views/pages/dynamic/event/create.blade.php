<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;
use function Livewire\Volt\{state, rules,updated};


name('event.create');


state([
    'steps' => [
        'step1' => [
            'name' => 'Basic info',
            'details' => 'Event name, description, and URL.',
            'icon' => '',
        ],
        'step2' => [
            'name' => 'Location',
            'details' => 'Event location and online event setup.',
            'icon' => '',
        ],
        'step3' => [
            'name' => 'Design',
            'details' => 'Event cover image, font and color.',
            'icon' => '',
        ],
    ],
    'currentStep' => 'step1',
    'logo_image' => '',
    'banner_image' => '',
    'QrcodeId' => '',
    'event' => [
        'name' => '',
        'description' => '',
        'location' => '',

        'one_day_event' => false,
        'start_date_time' => '',
        'end_date_time' => '',
        'date_time' => '',

        'duration' => '',
        'logo_image' => '',
        'banner_image' => '',
        'color' => '',
        'font' => '',
    ],
    'event_url' => '',
]);

$setCurrentStep = function ($step) {
    // remove all errors
    $this->resetErrorBag();
    if ($step == 'step2') {
        $this->validate(
            [
                'event.name' => 'required|min:3|max:255',
                'event_url' => 'required|min:3|max:255|unique:qr_codes,subdomain',
                'event.description' => 'required|min:20|max:500',
            ],
            [
                'event.name.required' => 'Event name is required',
                'event_url.required' => 'Event URL is required',
                'event.description.required' => 'Event description is required',
                'event.name.min' => 'Event name must be at least 3 characters',
                'event_url.min' => 'Event URL must be at least 3 characters',
                'event.description.min' => 'Event description must be at least 20 characters',
                'event.name.max' => 'Event name must be at most 255 characters',
                'event_url.max' => 'Event URL must be at most 255 characters',
                'event.description.max' => 'Event description must be at most 500 characters',
                'event_url.url' => 'Event URL must be a valid URL',
                'event_url.unique' => 'Event URL must be unique',
            ],
        );
    } elseif ($step == 'step3') {
        $this->validate(
            [
                'event.location' => 'required|min:3|max:255',
                'event.start_date_time' => 'required_if:event.one_day_event,false',
                'event.end_date_time' => 'required_if:event.one_day_event,false',
                'event.date_time' => 'required_if:event.one_day_event,true',
                'event.duration' => 'required_if:event.one_day_event,true|min:3|max:255',
            ],
            [
                'event.location.required' => 'Event location is required',
                'event.location.min' => 'Event location must be at least 3 characters',
                'event.location.max' => 'Event location must be at most 255 characters',
                'event.start_date_time.required_if' => 'Event start date and time is required',
                'event.end_date_time.required_if' => 'Event end date and time is required',
                'event.date_time.required_if' => 'Event date and time is required',
                'event.duration.required' => 'Event duration is required',
            ],
        );
    } elseif ($step == 'submit') {
        $this->validate(
            [
                'event.color' => 'nullable',
                'event.font' => 'nullable',
                'logo_image' => 'nullable',
                'banner_image' => 'nullable',
            ],
            [
                'event.color.required' => 'Event color is required',
                'event.font.required' => 'Event font is required',
                'cover_image.required' => 'Event cover image is required',
            ],
        );

        if ($this->logo_image) {
            $this->event['logo_image'] = 'storage/'.Support::uploadImage($this->logo_image, 'event', Str::slug($this->event['name']));
        }
        if ($this->banner_image) {
            $this->event['banner_image'] = 'storage/'.Support::uploadImage($this->banner_image, 'event', Str::slug($this->event['name']));
        }

        $data = [
            'qr_code_info' => $this->event,
            'subdomain' => $this->event_url,
            'type' => 'event',
            'name' => $this->event['name'],
            'is_dynamic' => true,
        ];

        $data = array_merge($data, Support::basicDataForQrCode());

        auth()
            ->user()
            ->qrCodes()
            ->create($data);

        toastr()->success('QR Code Created Successfully');
        return redirect()->route('my-qrcode.dynamic');
    }

    $this->currentStep = $step;
};


?>


<x-layouts.frontend>
    <div class="h-full">
        @volt('event.create')
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 mt-20 bg-white dark:bg-gray-800 rounded-lg shadow  p-6">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-4">
                    <ol
                        class="relative text-gray-500 border-l border-gray-200 dark:border-gray-700 dark:text-gray-400 border-r ">
                        @foreach ($steps as $key => $step)
                        <li class="mb-10 ml-6" wire:click="setCurrentStep('{{ $key }}')">
                            <span class="absolute flex items-center justify-center w-8 h-8 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900
                        {{ $currentStep == $key ? 'bg-green-200  dark:bg-green-900' : 'bg-gray-200' }}">
                                <svg class="w-3.5 h-3.5 {{ $currentStep == $key ? 'text-green-500 dark:text-green-400' : '' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                </svg>
                            </span>
                            <h3 class="font-medium leading-tight">
                                {{ $step['name'] }}
                            </h3>
                            <p class="text-sm">
                                {{ $step['details'] }}
                            </p>
                        </li>
                        @endforeach
                    </ol>
                </div>
                <div class="col-span-12 md:col-span-8">
                    <div class="grid grid-cols-12 gap-4 {{ $currentStep == 'step1' ? 'block' : 'hidden' }}">
                        <div class="col-span-12">
                            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Basic info</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Event name, description, and time zone.
                            </p>
                        </div>
                        <div class="col-span-12">
                            <x-input placeholder="Event name" id="name" wire:model="event.name"
                                class="col-span-6 mt-3" />
                            <x-input placeholder="Event URL" id="event_url" wire:model="event_url"
                                class="col-span-6 mt-3" />
                            <x-textarea placeholder="Description" id="description" wire:model="event.description"
                                rows="3" class="resize-none col-span-6 mt-3" />
                        </div>

                        <div class="col-span-12">
                            <div class="flex justify-between">
                                <x-button disabled>Back</x-button>
                                <x-button primary wire:click="setCurrentStep('step2')">Next</x-button>
                            </div>

                        </div>


                    </div>
                    <div class="grid grid-cols-12 gap-4 {{ $currentStep == 'step2' ? 'block' : 'hidden' }}">
                        <div class="col-span-12">
                            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Location</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Event location and online event setup.
                            </p>
                        </div>
                        <div class="col-span-12">
                            <x-input placeholder="Location" id="location" wire:model="event.location"
                                class="col-span-6" />
                            <div class="col-span-6 mt-2">
                                <x-toggle lg wire:model.live="event.one_day_event" label="One day event" />
                            </div>
                            <div
                                class="grid grid-cols-12 gap-4 mt-2 {{ $event['one_day_event'] ? 'hidden' : 'block' }}">
                                <div class="col-span-6">
                                    <x-datetime-picker placeholder="Start date and time"
                                        wire:model.defer="event.start_date_time" />
                                </div>
                                <div class="col-span-6">
                                    <x-datetime-picker placeholder="End date and time"
                                        wire:model.defer="event.end_date_time" />
                                </div>

                            </div>
                            <div
                                class="grid grid-cols-12 gap-4 mt-2 {{ $event['one_day_event'] ? 'block' : 'hidden' }}">
                                <div class="col-span-6">
                                    <x-datetime-picker placeholder="Date and time" wire:model.defer="event.date_time" />
                                </div>
                                <div class="col-span-6">
                                    <x-input placeholder="Duration" id="duration" wire:model="event.duration"
                                        class="col-span-6" />
                                </div>
                            </div>



                        </div>

                        <div class="col-span-12">
                            <div class="flex justify-between">
                                <x-button primary wire:click="setCurrentStep('step1')">Back</x-button>
                                <x-button primary wire:click="setCurrentStep('step3')">Next</x-button>
                            </div>

                        </div>


                    </div>
                    <div class="grid grid-cols-12 gap-4 {{ $currentStep == 'step3' ? 'block' : 'hidden' }}">
                        <div class="col-span-12">
                            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Design</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Event cover image, font and color.</p>
                        </div>

                        <div class="col-span-12">
                            <x-tw.file-attachment name="logo_image" class="col-span-6 mt-3"
                                value="{{ $event['logo_image'] ?? '' }}" profile-class="w-24 h-24 rounded-lg"
                                accept="image/jpg,image/jpeg,image/png">
                                <span class="ml-2 text-gray-600">Upload logo | <span class="text-sm">PNG or
                                        JPEG</span></span>
                            </x-tw.file-attachment>
                            <x-tw.file-attachment name="banner_image" class="col-span-6 mt-3"
                                value="{{ $event['banner_image'] ?? '' }}" profile-class="w-24 h-24 rounded-lg"
                                accept="image/jpg,image/jpeg,image/png">
                                <span class="ml-2 text-gray-600">Upload Banner | <span class="text-sm">PNG or
                                        JPEG</span></span>
                            </x-tw.file-attachment>
                            <x-color-picker placeholder="Select the color" wire:model="event.color"
                                class="col-span-6 mt-3 dark:bg-white-800" />
                            <x-select placeholder="Select the font" :options="Support::eventFonts()" option-label="name"
                                option-value="name" wire:model.defer="event.font" class="mt-3" />

                        </div>

                        <div class="col-span-12">
                            <div class="flex justify-between">
                                <x-button disabled>Back</x-button>
                                <x-button primary wire:click="setCurrentStep('submit')">Submit</x-button>
                            </div>

                        </div>


                    </div>

                </div>

            </div>
        </div>
        @endvolt
    </div>
</x-layouts.frontend>

@push('css')
<style>
    .hidden {
        display: none;
    }
</style>
@endpush
