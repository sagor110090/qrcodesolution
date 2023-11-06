<x-layouts.dynamic>

    <x-slot name="title">
        <title> Image </title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" sizes="16x16">
    </x-slot>
    <div class="mx-auto h-[calc(100vh)]">
        {{-- preview image --}}
        <img src="{{ asset('storage/'.$image->image) }}" alt="image" class="w-full h-full object-cover">
    </div>
</x-layouts.dynamic>
