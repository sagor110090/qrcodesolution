<div>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <livewire:user.user-table />
        </div>
    </div>
</div>
