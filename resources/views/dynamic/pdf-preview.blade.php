<x-layouts.dynamic>

    <x-slot name="title">
        <title> PDF </title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" sizes="16x16">
    </x-slot>
    <div class="mx-auto h-[calc(100vh)]">
        {{-- preview pdf --}}
        <embed src="{{ asset('storage/'.$pdf->pdf) }}"
            type="application/pdf" frameBorder="0" scrolling="auto" height="100%" width="100%"></embed>
    </div>
</x-layouts.dynamic>
