<x-layouts.dynamic>

    <x-slot name="title">
        <title> {{ $event->name }}</title>
        <meta name="description" content="{{ $event->description }}">
        <link rel="icon" href="{{ asset($event->logo_image) }}" type="image/png" sizes="16x16">
    </x-slot>
    <div class="mx-auto h-[calc(100vh)]">
        <div class="flex flex-col items-center justify-center mb-16 sm:text-center sm:mb-0">
            <img src="{{ asset($event->banner_image) }}" alt="logo" class="w-full h-[calc(30vh)] object-cover">

            <div class="w-screen p-20 leading-normal text-center text-gray-800 bg-white rounded shadow-lg sm:max-w-xl md:max-w-full lg:max-w-screen-xl"
                style="background:{{ $event->color }};">
                <div class="mb-3 sm:mx-auto">
                    <div class="flex items-center justify-center">
                        @if ($event->logo_image)
                            <img src="{{ asset($event->logo_image) }}" alt="logo" class="main-content-logo">
                        @endif
                    </div>
                    <h2 class="mb-6 font-sans text-xl font-bold text-center text-gray-900"
                        style="color:{{ Support::visibleColor($event->color) }}; font-family: {{ $event->font }};font-size:20px;">
                        {{ $event->name }}
                    </h2>
                </div>
                <div
                    class="flex flex-wrap items-center justify-center p-5 leading-normal text-center text-gray-800 md:p-20 sm:max-w-xl md:max-w-full lg:max-w-screen-xl">
                    <div class="flex flex-col items-center justify-center mb-5">
                        @if ($event->one_day_event)
                            <p class="text-base text-gray-700 md:text-lg"
                                style="color:{{ Support::visibleColor($event->color) }}; font-family: {{ $event->font }};font-size:20px;">
                                {{ Carbon\Carbon::parse($event->date_time)->format('d M Y H:i A') }}
                            </p>
                        @else
                            <p class="text-base text-gray-700 md:text-lg"
                                style="color:{{ Support::visibleColor($event->color) }}; font-family: {{ $event->font }};font-size:20px;">
                                {{ Carbon\Carbon::parse($event->start_date_time)->format('d M Y h:i A') }} -
                                {{ Carbon\Carbon::parse($event->end_date_time)->format('d M Y h:i A') }}
                            </p>
                        @endif
                        @if ($event->location)
                            <p class="text-base text-gray-700 md:text-lg"
                                style="color:{{ Support::visibleColor($event->color) }}; font-family: {{ $event->font }};font-size:20px;">
                            <div class="flex items-center justify-center"
                                style="color:{{ Support::visibleColor($event->color) }}; font-family: {{ $event->font }};font-size:20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg> {{ $event->location }}
                            </div>
                            </p>
                        @endif
                    </div>
                </div>
                <p class="text-base text-gray-700 md:text-lg"
                    style="color:{{ Support::visibleColor($event->color) }}; font-family: {{ $event->font }};font-size:20px;">
                    {!! $event->description !!}
                </p>
            </div>
            <div class="flex flex-col items-start justify-start w-screen mt-10 text-gray-800 bg-white rounded shadow-lg sm:max-w-xl md:max-w-full lg:max-w-screen-xl"
                style="background:{{ $event->color }};">
                <div class="p-10"
                    style="padding: 20px;text-align: left;color:{{ Support::visibleColor($event->color) }}; font-family: {{ $event->font }};font-size:20px;">
                    {{ str_replace('http://', '', str_replace('https://', '', url()->current())) }}
                </div>
            </div>
        </div>

    </div>
    @push('css')
        <style>
            .main-content-logo {
                display: block;
                max-width: 160px;
                margin: 0 auto;
                margin-top: -50px;
                filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.125));
                margin-bottom: 1em;
                border-radius: 10%;
                height: 160px;
                width: 160px;
                margin-top: -150px;
            }

            .menu-types-contaier {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
                gap: 1em;
                margin-top: 1em;
            }

            .zoom {
                transition: transform .2s;
            }

            .zoom:hover {
                transform: scale(1.1);
            }
        </style>
    @endpush
</x-layouts.dynamic>
