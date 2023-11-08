<x-layouts.main>

        <x-slot name="seo">

            @if (!isset($seo))
                <title>{{ config('app.name') }}</title>
            @else
                {{$seo}}
            @endif
        </x-slot>


    <x-ui.frontend.header />
    <div class="main">
        {{ $slot }}
    </div>

    <x-layouts.footer />


</x-layouts.main>
