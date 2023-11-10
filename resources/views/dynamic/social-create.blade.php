<?php

use Livewire\Volt\Component;
use function Livewire\Volt\{state, rules, updated};

state([
    'steps' => [
        'step1' => [
            'name' => 'Basic info',
            'details' => 'Social name, description, and URL.',
            'icon' => '',
        ],
        'step2' => [
            'name' => 'Links',
            'details' => 'Social links.',
            'icon' => '',
        ],
        'step3' => [
            'name' => 'Design',
            'details' => 'Social cover image, font and color.',
            'icon' => '',
        ],
    ],
    'currentStep' => 'step2',
    'logo_image' => '',
    'banner_image' => '',
    'QrcodeId' => '',
    'social' => [
        'name' => '',
        'email' => '',
        'phone' => '',

        'link_name' => [],
        'link_url' => [],
        'link_icon' => [],

        'logo_image' => '',
        'banner_image' => '',
        'color' => '',
        'font' => '',
    ],
    'custom_url' => '',
]);

$setCurrentStep = function ($step) {
    // remove all errors
    $this->resetErrorBag();
    if ($step == 'step2') {
        $this->validate(
            [
                'social.name' => 'required|min:3|max:255',
                'social.email' => 'required|email|min:3|max:255',
                'social.phone' => 'required|min:3|max:255',
                'custom_url' => 'required|min:3|max:255|unique:qr_codes,subdomain',
            ],
            [
                'social.name.required' => 'Social name is required',
                'social.name.min' => 'Social name must be at least 3 characters',
                'social.name.max' => 'Social name must be at most 255 characters',
                'social.email.required' => 'Social email is required',
                'social.email.min' => 'Social email must be at least 3 characters',
                'social.email.max' => 'Social email must be at most 255 characters',
                'social.phone.required' => 'Social phone is required',
                'social.phone.min' => 'Social phone must be at least 3 characters',
                'social.phone.max' => 'Social phone must be at most 255 characters',
                'custom_url.required' => 'Custom URL is required',
                'custom_url.min' => 'Custom URL must be at least 3 characters',
                'custom_url.max' => 'Custom URL must be at most 255 characters',
                'custom_url.unique' => 'Custom URL is already taken',
            ],
        );
    } elseif ($step == 'step3') {
        dd($this->social);
        // $this->validate(
        //     [
        //         'social.logo_image' => 'required',
        //         'social.banner_image' => 'required',
        //         'event.color' => 'required',
        //         'event.font' => 'required',

        //     ],
        //     [
        //     ],
        // );
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
            $this->event['logo_image'] = 'storage/' . Support::uploadImage($this->logo_image, 'event', Str::slug($this->event['name']));
        }
        if ($this->banner_image) {
            $this->event['banner_image'] = 'storage/' . Support::uploadImage($this->banner_image, 'event', Str::slug($this->event['name']));
        }

        $data = [
            'qr_code_info' => $this->event,
            'subdomain' => $this->event_url,
            'type' => 'event',
            'name' => $this->event['name'],
            'is_dynamic' => true,
        ];

        $data = array_merge($data, Support::basicDataForQrCode());

        if (auth()->check() == false) {
            Support::saveRequestData($data);
            return redirect()->route('login');
        }

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
        @volt('social.create')
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 mt-20 bg-white dark:bg-gray-800 rounded-lg shadow  p-6">

                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-4">
                        <ol
                            class="relative text-gray-500 border-l border-gray-200 dark:border-gray-700 dark:text-gray-400 border-r ">
                            @foreach ($steps as $key => $step)
                                <li class="mb-10 ml-6" wire:click="setCurrentStep('{{ $key }}')">
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900
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
                                <p class="text-sm text-gray-500 dark:text-gray-400">Social name, email,phone numberand URL.
                                </p>
                            </div>
                            <div class="col-span-12">
                                <x-input placeholder="Socail name" id="name" wire:model="social.name"
                                    class="mt-3 col-span-6" />
                                <x-input placeholder="Email" id="email" wire:model="social.email"
                                    class="mt-3 col-span-6" />
                                <x-input placeholder="Phone number" id="phone" wire:model="social.phone"
                                    class="mt-3 col-span-6" />
                                <x-input placeholder="Custom URL" id="custom_url" wire:model="custom_url"
                                    class="mt-3 col-span-6" />

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
                                <p class="text-sm text-gray-500 dark:text-gray-400">Social links.
                                </p>
                            </div>
                            <div class="col-span-12" x-data="{
                                'link_name': '',
                                'link_url': '',
                                'link_icon': '',
                                'fields': [{
                                    'link_name': '',
                                    'link_url': '',
                                    'link_icon': '',
                                }, ],
                                'addLink': function() {
                                    this.fields.push({
                                        'link_name': this.link_name,
                                        'link_url': this.link_url,
                                        'link_icon': this.link_icon,
                                    });
                                    this.link_name = '';
                                    this.link_url = '';
                                    this.link_icon = '';
                                },
                            }" x-init="() => {
                                $watch('fields', (value) => {
                                    @this.set('social.link_name', value.map((item) => item.link_name));
                                    @this.set('social.link_url', value.map((item) => item.link_url));
                                    @this.set('social.link_icon', value.map((item) => item.link_icon));
                                });
                            }">
                                <template x-for="(field, index) in fields" :key="index">
                                    <div x-transition>
                                        <x-input placeholder="Link name" id="link_name" x-model="field.link_name"
                                            class="mt-3 col-span-6" />
                                        <x-input placeholder="Link URL" id="link_url" x-model="field.link_url"
                                            class="mt-3 col-span-6" />
                                            <x-select-social-icon placeholder="Select the icon" x-model="field.link_icon" class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm mt-3 col-span-6"
                                              />
                                        {{-- <x-select-input x-model="field.link_icon" class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm mt-3 col-span-6">
                                            @foreach (Support::socialIcons() as $key => $icon)
                                                <option value="{{$key}}">
                                                    {{$icon}}
                                                </option>
                                            @endforeach
                                        </x-select-input> --}}
                                        <hr class="my-3 border-gray-200 dark:border-gray-700"
                                            x-show='index < fields.length - 1'>

                                    </div>
                                </template>

                                <x-button.circle positive label="+" class="mt-3 float-right" x-on:click="addLink()" />

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
                                    value="{{ $social['logo_image'] ?? '' }}" profile-class="w-24 h-24 rounded-lg"
                                    accept="image/jpg,image/jpeg,image/png">
                                    <span class="ml-2 text-gray-600">Upload logo | <span class="text-sm">PNG or
                                            JPEG</span></span>
                                </x-tw.file-attachment>
                                <x-tw.file-attachment name="banner_image" class="col-span-6 mt-3"
                                    value="{{ $social['banner_image'] ?? '' }}" profile-class="w-24 h-24 rounded-lg"
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
