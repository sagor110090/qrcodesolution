<div>
    <div>
        <x-slot name="header">
            {{ __('Pages') }}
        </x-slot>
        <x-primary-button onclick="window.location.href='{{ route('pages.create') }}'" class="mb-10 flex justify-right">
            {{ __('Create Page') }}
        </x-primary-button>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <livewire:page.page-table />
            </div>
        </div>
    </div>

</div>
