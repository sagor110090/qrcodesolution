<div>
    <x-slot name="header">
        {{ __('Posts') }}
    </x-slot>
    <x-primary-button onclick="window.location.href='{{ route('posts.create') }}'" class="mb-10 flex justify-right">
        {{ __('Create Post') }}
    </x-primary-button>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <livewire:post.post-table />
        </div>
    </div>
</div>
