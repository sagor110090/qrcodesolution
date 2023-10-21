<div>
    <x-slot name="header">
        {{ __('Tags') }}
    </x-slot>
    <x-primary-button onclick="Livewire.dispatch('openModal',{ component: 'tag.create-tag'  })" class="mb-10 flex justify-right">
        {{ __('Create Tag') }}
    </x-primary-button>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <livewire:tag.tag-table />
        </div>
    </div>
</div>
