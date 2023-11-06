<x-layouts.dynamic>

    <x-slot name="title">
        <title> AUDIO </title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" sizes="16x16">
    </x-slot>
    <div class="mx-auto h-[calc(100vh)]">
        {{-- preview audio --}}
        <audio controls>
            <source src="{{ asset('storage/'.$audio->audio) }}" type="audio/mpeg">
            <source src="{{ asset('storage/'.$audio->audio) }}" type="audio/ogg">
            <source src="{{ asset('storage/'.$audio->audio) }}" type="audio/wav">
            <source src="{{ asset('storage/'.$audio->audio) }}" type="audio/mp3">
            Your browser does not support the audio element.
        </audio>
    </div>
</x-layouts.dynamic>
