<div>
    <x-slot name="header">
        {{ __('Categories') }}
    </x-slot>
    <x-primary-button onclick="Livewire.dispatch('openModal', { component: 'category.create-category' } )" class="mb-10 flex justify-right">
        {{ __('Create Category') }}
    </x-primary-button>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <livewire:category.categories-table />
        </div>
    </div>
</div>
