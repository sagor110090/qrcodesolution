<x-layouts.dynamic>

    <x-slot name="title">
        <title> VIDEO </title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" sizes="16x16">
    </x-slot>
    <div class="mx-auto h-[calc(100vh)]">
        {{-- preview video --}}
        <video controls class="w-full h-full object-cover">
            <source src="{{ asset('storage/'.$video->video) }}" type="video/mp4">
            <source src="{{ asset('storage/'.$video->video) }}" type="video/ogg">
            <source src="{{ asset('storage/'.$video->video) }}" type="video/webm">
            <source src="{{ asset('storage/'.$video->video) }}" type="video/mov">
            <source src="{{ asset('storage/'.$video->video) }}" type="video/avi">
            Your browser does not support the video tag.
        </video>
    </div>
</x-layouts.dynamic>
