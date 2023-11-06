<x-layouts.dynamic>

    <x-slot name="title">
        <title> {{$event->name}}</title>
        <meta name="description" content="{{$event->description}}">
        <link rel="icon" href="{{ asset($event->logo_image) }}" type="image/png" sizes="16x16">
    </x-slot>
    <div class="mx-auto h-[calc(100vh)]">
        <div class="flex flex-col mb-16 sm:text-center sm:mb-0 justify-center items-center">
            <img src="{{asset($event->banner_image)}}" alt="logo" class="w-full opacity-50 h-[calc(30vh)] object-cover">

            <div
                class="bg-white rounded-lg shadow-lg p-5 md:p-20 text-gray-800 leading-normal text-center sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20"
                style="margin-top:-100px;">
                >
                <a href="/" class="mb-3 sm:mx-auto">
                    <div class="flex items-center justify-center">
                        @if ($event->logo_image)
                        <img src="{{asset($event->logo_image)}}" alt="logo" class="main-content-logo">
                        @endif
                    </div>
                    <h2 class="mb-6 font-sans text-xl font-bold text-center text-gray-900">
                        {{$event->name}}
                    </h2>
                </a>
                <div class="bg-white rounded-lg shadow-lg p-5 md:p-20 text-gray-800 leading-normal text-center sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20"
                    style="background:{{ $event->color }};">
                    <p class="text-base text-gray-700 md:text-lg"
                        style="color:{{ Support::visibleColor($event->color) }}; font-family: {{$event->font}};font-size:20px;">
                        {{$event->description}}
                    </p>
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
        }

        .menu-types-contaier {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 1em;
            margin-top: 1em;
        }

        /* .preview {
            position: relative;

        }

        .preview:before {
            content: ' ';
            display: block;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 0.6;
            background-image: url('{{asset($event->banner_image)}}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            z-index: 0;

        }

        .preview-content {
            position: relative;
            z-index: 1;

        } */
    </style>
    @endpush
</x-layouts.dynamic>
