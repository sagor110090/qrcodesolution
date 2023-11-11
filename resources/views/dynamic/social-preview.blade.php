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
                    <h2 class="mb-6 font-sans text-xl font-bold text-center text-gray-900"
                        style="color:{{ Support::visibleColor($social->color) }}; font-family: {{ $social->font }};font-size:20px;">
                        {{ $social->name }}
                    </h2>
                </div>
                <div
                    class="p-5 md:p-20 text-gray-800 leading-normal text-center sm:max-w-xl md:max-w-full lg:max-w-screen-xl  flex flex-wrap justify-center items-center">
                    @foreach ($social->links as $link)
                        @php
                            $link = (object) $link;
                        @endphp
                        <div class="grid grid-cols-2 gap-1  text-center text-gray-800 bg-white rounded-lg shadow-lg zoom hover:shadow-xl transition-shadow duration-300 ease-in-out"
                            style="width: 400px; height: 50px;cursor: pointer;"
                            onclick="window.open('{{ Support::checkUrl($link->link_url) }}', '_blank')">
                            <div class="flex items-center justify-center">
                                {!! Support::socialIcons($link->link_icon) !!}
                            </div>
                            <div class="flex items-center justify-center">
                                <h4 class="text-lg font-semibold text-gray-700 dark:text-white">
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
