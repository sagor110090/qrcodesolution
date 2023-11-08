<x-layouts.main>

    @if ($seo ?? true)
        <x-slot name="seo">
            {{$seo ?? ''}}
        </x-slot>
    @endif


    <x-ui.frontend.header />
    <div class="main">
        {{ $slot }}
    </div>

    <x-layouts.footer />


</x-layouts.main>
