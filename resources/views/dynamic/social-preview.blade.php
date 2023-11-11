<x-layouts.dynamic>

    <x-slot name="title">
        <title> {{ $social->name }}</title>
        <link rel="icon" href="{{ asset($social->logo_image) }}" type="image/png" sizes="16x16">
    </x-slot>
    <div class="mx-auto h-[calc(100vh)]">
        <div class="flex flex-col mb-16 sm:text-center sm:mb-0 justify-center items-center">
            <img src="{{ asset($social->banner_image) }}" alt="logo"
                class="w-full opacity-50 h-[calc(30vh)] object-cover">

            <div class="bg-white rounded shadow-lg p-20 text-gray-800 leading-normal text-center sm:max-w-xl md:max-w-full lg:max-w-screen-xl  w-screen"
                style="background:{{ $social->color }};">
                <div class="mb-3 sm:mx-auto">
                    <div class="flex items-center justify-center">
                        @if ($social->logo_image)
                            <img src="{{ asset($social->logo_image) }}" alt="logo" class="main-content-logo">
                        @endif
                    </div>
                    <h2 class="mb-3 font-sans text-xl font-bold text-center text-gray-900"
                        style="color:{{ Support::visibleColor($social->color) }}; font-family: {{ $social->font }};font-size:20px;">
                        {{ $social->name }}
                    </h2>

                    <div class="mb-6 text-center text-gray-900 flex flex-col justify-center items-center">
                        @if ($social->email)
                            <a href="mailto:{{ $social->email }}"  class="flex items-center text-center gap-1"
                                style="color:{{ Support::visibleColor($social->color) }}; font-family: {{ $social->font }};font-size:16px;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg> {{ $social->email }}
                            </a>
                        @endif
                        @if ($social->phone)
                            <a href="tel:{{ $social->phone }}" class="flex items-center text-center gap-1"
                                style="color:{{ Support::visibleColor($social->color) }}; font-family: {{ $social->font }};font-size:16px;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg> {{ $social->phone }}
                            </a>
                        @endif

                    </div>
                </div>
                <div
                    class="p-5 md:p-20 text-gray-800 leading-normal text-center sm:max-w-xl md:max-w-full lg:max-w-screen-xl  flex flex-col justify-center items-center">
                    @foreach ($social->links as $link)
                        @php
                            $link = (object) $link;
                        @endphp
                        <div class="text-center text-gray-800 bg-white rounded-lg shadow-lg zoom hover:shadow-xl transition-shadow duration-300 ease-in-out mt-2 flex items-center justify-center gap-2"
                            style="width: 350px; height: 50px;cursor: pointer;color:{{ Support::visibleColor($social->color) }}; font-family: {{ $social->font }};font-size:16px;"
                            onclick="window.open('{{ Support::checkUrl($link->link_url) }}', '_blank')">
                            <div class="flex items-center justify-center gap-2">
                                <div class="">
                                    {!! Support::socialIcons($link->link_icon) !!}
                                </div>
                                <h4 class="text-lg font-semibold text-gray-700 dark:text-white flex items-center justify-start">

                                    {{ $link->link_name }}
                                </h4>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white rounded shadow-lg  mt-10 md:m-5 text-gray-800   sm:max-w-xl md:max-w-full lg:max-w-screen-xl  w-screen flex flex-col justify-start items-start"
                style="background:{{ $social->color }};">
                <div class="p-10"
                    style="padding: 20px;text-align: left;color:{{ Support::visibleColor($social->color) }}; font-family: {{ $social->font }};font-size:20px;">
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
