<x-layouts.main>
    @push('css')

    @endpush

    @push('js')

    @endpush
    <x-ui.frontend.header />

    {{ $slot }}
</x-layouts.main>


