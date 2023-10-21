<div>
    <div class='flex items-center justify-center'>
        <div class='w-full  px-10 py-8 mx-auto  bg-white rounded-xl shadow-xl'>
            <h3>
                <div class='flex items-center justify-between'>
                    <span class='text-2xl font-bold text-gray-900'>Create Post </span>
                </div>
            </h3>
            <x-errors class="mt-3" />
            <form method="post" class="mt-6 space-y-6" wire:submit="store">
                <div class='max-w-md  space-y-6'>
                    <div>
                        <x-input label="Title" placeholder="Post title" wire:model.live="title" :value="old('title')"
                            autofocus autocomplete="title" />
                    </div>
                    {{-- slug --}}
                    <div>
                        <x-input label="Slug" placeholder="Post slug" wire:model="slug" :value="old('slug')" />
                    </div>
                    {{-- thumbnail --}}
                    <div>
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" class="mb-2" />
                        <x-ui.file-attachment
                        wire:model="thumbnail"
                        :file="$thumbnail"
                        mode="attachment"
                        profile-class="w-24 h-24 rounded-lg"
                        accept="image/jpg,image/jpeg,image/png"
                        />
                    </div>
                    {{-- categories --}}
                    <x-select label="Search a Category" wire:model="categories" placeholder="Search a Category"
                        :async-data="route('api.category.index')" option-label="name" option-value="id" multiselect />
                </div>
                <div class=" space-y-6">
                    {{-- content --}}
                    <div wire:ignore>
                        <x-input-label for="content" :value="__('Content')" class="mb-2" />
                        <x-ck-textarea id="content" name='content' wire:model="content" :value="old('content')"
                            class="block w-full mt-1" />
                    </div>
                </div>
                <div class="max-w-md  space-y-6">
                    {{-- tags --}}
                    <x-select label="Search a Tag" wire:model="tags" placeholder="Search a Tag" :async-data="route('api.tag.index')"
                        option-label="name" option-value="id" multiselect />
                    {{-- meta_title --}}
                    <x-textarea label="Meta Title" placeholder="Meta Title" wire:model="meta_title" :value="old('meta_title')" />
                    {{-- meta_description --}}
                    <x-textarea label="Meta Description" placeholder="Meta Description" wire:model="meta_description"
                        :value="old('meta_description')" />
                    {{-- meta_keywords --}}
                    <x-textarea label="Meta Keywords" placeholder="Meta Keywords" wire:model="meta_keywords"
                        :value="old('meta_keywords')" />

                    {{-- is_featured --}}
                    <div>
                        <x-input-label for="is_featured" :value="__('Featured')" class="mb-2" />
                        <x-radio id="right-label" label="Featured" value="1" wire:model="is_featured"
                            checked="true" />
                        <x-radio id="right-label" label="Not Featured" value="0" wire:model="is_featured"
                            class="mt-2" />
                    </div>

                    {{-- published_at --}}
                    <div>
                        <x-datetime-picker label="Published  Date" placeholder="Published Date"
                            wire:model="published_at" />
                    </div>

                    {{-- is_active  --}}
                    <div>
                        <x-input-label for="is_active" :value="__('Status')" class="mb-2" />
                        <x-radio id="right-label" label="Active" value="1" wire:model="is_active" checked="true" />
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
