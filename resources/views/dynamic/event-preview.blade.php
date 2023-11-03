<x-layouts.dynamic>

    <x-slot name="title">
        <title> {{$event->name}}</title>
        <meta name="description" content="{{$event->description}}">
        <link rel="icon" href="{{ asset($event->logo_image) }}" type="image/png" sizes="16x16">
    </x-slot>
    <div class="mx-auto  sm:px-6 lg:px-8 preview  h-[calc(100vh)]">
        <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl">
                <div class="flex flex-col mb-16 sm:text-center sm:mb-0 preview-content">
                    <a href="/" class="mb-3 sm:mx-auto">
                        <div class="flex items-center justify-center">
                            @if ($event->logo_image)
                                <img src="{{asset($event->logo_image)}}" alt="logo" class="w-20 h-20 border-2 border-gray-300 rounded">
                            @endif
                        </div>
                        <h2
                            class="mb-6 font-sans text-xl font-bold text-center text-gray-900">
                            {{$event->name}}
                        </h2>
                    </a>
                    <div class="w-full bg-white rounded-lg shadow-lg p-5 md:p-20 text-gray-800 leading-normal text-center"
                        style="background:{{ $event->color }};">
                        <p class="text-base text-gray-700 md:text-lg" style="color:{{ Support::visibleColor($event->color) }}; font-family: {{$event->font}};font-size:20px;">
                            {{$event->description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
    <style>
        .preview {
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

        }
    </style>
    @endpush
</x-layouts.dynamic>
