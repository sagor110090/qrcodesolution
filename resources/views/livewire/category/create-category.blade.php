<div>
    <div class='flex items-center justify-center'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
            <h3>
                <div class='flex items-center justify-between'>
                    <span class='text-2xl font-bold text-gray-900'>Create Category</span>
                    <button wire:click="$dispatch('closeModal')" class='text-gray-400 hover:text-gray-500'>
                        <svg class='w-6 h-6 fill-current' viewBox='0 0 24 24'>
                            <path
                                d='M19.41 7.41L18 6l-6 6-6-6L4.59 7.41 12
                             15.01l7.41-7.42z' />
                        </svg>
                    </button>
                </div>
            </h3>
            <div class='max-w-md mx-auto space-y-6'>
                <form method="post" class="mt-6 space-y-6" wire:submit="store">
                    <div>
                        <x-input label="Name" placeholder="Category name" wire:model.live="name" :value="old('name')"
                            autofocus autocomplete="name" />
                    </div>
                    {{-- slug --}}
                    <div>
                        <x-input label="Slug" placeholder="Category slug" wire:model="slug"
                            :value="old('slug')" />
                    </div>

                    {{-- meta_title --}}
                    <x-textarea label="Meta Title" placeholder="Meta Title" wire:model="meta_title"
                        :value="old('meta_title')" />
                    {{-- meta_description --}}
                    <x-textarea label="Meta Description" placeholder="Meta Description"
                        wire:model="meta_description" :value="old('meta_description')" />
                    {{-- meta_keywords --}}
                    <x-textarea label="Meta Keywords" placeholder="Meta Keywords" wire:model="meta_keywords"
                        :value="old('meta_keywords')" />


                    {{-- parent_id --}}
                    <div>
                        <x-native-select label="Select Category" wire:model.live="parent_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-native-select>
                    </div>


                    {{-- is_active  --}}
                    <div>
                        <x-radio id="right-label" label="Active" value="1" wire:model="is_active"  checked="true"  />
                        <x-radio id="right-label" label="Inactive" value="0" wire:model="is_active"
                            class="mt-2" />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
