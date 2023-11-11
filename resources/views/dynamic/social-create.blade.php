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
    'currentStep' => 'step1',
    'logo_image' => '',
    'banner_image' => '',
    'QrcodeId' => '',
    'social' => [
        'name' => '',
        'email' => '',
        'phone' => '',
        'links' => [
            [
                'link_name' => '',
                'link_url' => '',
                'link_icon' => '',
            ],
        ],

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
                'social.email' => 'nullable|email|min:3|max:255',
                'social.phone' => 'nullable|min:3|max:255',
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
        $this->validate(
            [
                'social.links' => 'required|array',
                'social.links.*.link_name' => 'required|string',
                'social.links.*.link_url' => 'required|string|url',
                'social.links.*.link_icon' => 'required|string',

            ],
            [
                'social.links.required' => 'Social links is required',
                'social.links.array' => 'Social links must be an array',
                'social.links.*.link_name.required' => 'Social link name is required',
                'social.links.*.link_name.string' => 'Social link name must be a string',
                'social.links.*.link_url.required' => 'Social link url is required',
                'social.links.*.link_url.string' => 'Social link url must be a string',
                'social.links.*.link_icon.required' => 'Social link icon is required',
                'social.links.*.link_icon.string' => 'Social link icon must be a string',
            ],
        );
    } elseif ($step == 'submit') {
        $this->validate(
            [
                'social.color' => 'nullable',
                'social.font' => 'nullable',
                'logo_image' => 'nullable',
                'banner_image' => 'nullable',
            ],
            [
                'social.color.required' => 'Social color is required',
                'social.font.required' => 'Social font is required',
            ],

        );

        if ($this->logo_image) {
            $this->social['logo_image'] = 'storage/' . Support::uploadImage($this->logo_image, 'social', Str::slug($this->social['name']));
        }
        if ($this->banner_image) {
            $this->social['banner_image'] = 'storage/' . Support::uploadImage($this->banner_image, 'social', Str::slug($this->social['name']));
        }

        $data = [
            'qr_code_info' => $this->social,
            'subdomain' => $this->custom_url,
            'type' => 'social',
            'name' => $this->social['name'],
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
                                        class="absolute flex items-center justify-center w-8 h-8 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 {{ $currentStep == $key ? 'bg-green-200  dark:bg-green-900' : 'bg-gray-200' }}">
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
                                    @this.set('social.links', value);
                                });
                            }">

                                <template x-for="(field, index) in fields" :key="index">
                                    <div x-transition>
                                        <x-input placeholder="Link name" id="link_name" x-model="field.link_name"
                                            class="mt-3 col-span-6" />
                                        <x-error name="social.links.*.link_name" />
                                        <x-input placeholder="Link URL" id="link_url" x-model="field.link_url"
                                            class="mt-3 col-span-6" />
                                        <x-error name="social.links.*.link_url" />
                                            <x-select-social-icon placeholder="Select the icon"
                                            :icons="Support::socialIcons()"  x-model="field.link_icon"
                                              />
                                        <x-error name="social.links.*.link_url" />
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
                                <x-color-picker placeholder="Select the color" wire:model="social.color"
                                    class="col-span-6 mt-3 dark:bg-white-800" />
                                <x-select placeholder="Select the font" :options="Support::eventFonts()" option-label="name"
                                    option-value="name" wire:model.defer="social.font" class="mt-3" />

                            </div>

                            <div class="col-span-12">
                                <div class="flex justify-between">
                                    <x-button primary wire:click="setCurrentStep('step2')">Back</x-button>
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
