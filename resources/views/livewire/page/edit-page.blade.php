<div>
    <div class='flex items-center justify-center'>
        <div class='w-full  px-10 py-8 mx-auto  bg-white rounded-xl shadow-xl'>
            <h3>
                <div class='flex items-center justify-between'>
                    <span class='text-2xl font-bold text-gray-900'>Create Page </span>
                </div>
            </h3>

            <x-errors class="mt-3"/>
            <form method="post" class="mt-6 space-y-6" wire:submit="update">
                <div class='max-w-md  space-y-6'>
                    <div>
                        <x-input label="Name" placeholder="Page Name" wire:model.live="name" :value="old('name')" autofocus
                            autocomplete="name" />
                    </div>
                    {{-- slug --}}
                    <div>
                        <x-input label="Slug" placeholder="Post slug" wire:model="slug" :value="old('slug')" />
                    </div>
                </div>
                <div class=" space-y-6">
                    {{-- content --}}
                    <div wire:ignore>
                        <x-input-label for="content" :value="__('Content')" class="mb-2" />
                        <x-ck-textarea id="content" name='content' wire:model="content"
                        :value="old('content')" class="block w-full mt-1" />
                    </div>
                </div>
                <div class="max-w-md  space-y-6">
                    {{-- meta_title --}}
                    <x-textarea label="Meta Title" placeholder="Meta Title" wire:model="meta_title"
                        :value="old('meta_title')" />
                    {{-- meta_description --}}
                    <x-textarea label="Meta Description" placeholder="Meta Description"
                        wire:model="meta_description" :value="old('meta_description')" />
                    {{-- meta_keywords --}}
                    <x-textarea label="Meta Keywords" placeholder="Meta Keywords" wire:model="meta_keywords"
                        :value="old('meta_keywords')" />



                    {{-- is_active  --}}
                    <div>
                        <x-input-label for="is_active" :value="__('Status')" class="mb-2" />
                        <x-radio id="right-label" label="Active" value="1" wire:model="is_active"
                            checked="true" />
                        <x-radio id="right-label" label="Inactive" value="0" wire:model="is_active"
                            class="mt-2" />
                    </div>

                </div>
                <div class="flex items-center gap-4 mt-10">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
