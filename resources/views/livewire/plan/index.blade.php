<div>
    <x-slot name="header">
        {{ __('Plans') }}
    </x-slot>
    <x-primary-button onclick="Livewire.dispatch('openModal',{ component: 'plan.create-plan'  })" class="mb-10 flex justify-right">
        {{ __('Create Plan') }}
    </x-primary-button>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <livewire:plan.plan-table />
        </div>
    </div>
</div>
