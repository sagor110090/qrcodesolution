@props([
    'file' => null,
    'accept' => 'image/jpg,image/jpeg,image/png,application/pdf',
    'profileClass' => 'w-20 h-20 rounded-full',
    'name' => 'file',
])

<div x-data="{
    isFocused: false,
    imagePreview: false,
    preview() {
        const file = this.$refs.{{$name.'1'}}.files[0];
        const reader = new FileReader();
        reader.onload = (e) => {
            this.$refs.{{$name}}.src = e.target.result;
            this.imagePreview = true;
           @this.set('{{$name}}',e.target.result);
        };
        reader.readAsDataURL(file);
    },

}" x-cloak  wire:ignore x-key="{{$name}}">

    <div>
        <label for="{{$name}}"
            class="relative block leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden
            border-2 w-full pl-3 pr-4 py-2 rounded-lg border-dashed"
            wire:loading.class="pointer-events-none" :class="{ 'border-indigo-300': isFocused === true }">

            <input type="file" id="{{$name}}"
                class="absolute inset-0 cursor-pointer opacity-0 text-transparent sr-only" accept="{{ $accept }}"
                x-ref="{{$name.'1'}}" x-on:input.change="preview()" />

                <img x-ref="{{$name}}"  src="" alt=""  style="height: 80px; width: 80px;"
                x-show="imagePreview" />
            <div class="flex items-center justify-center flex-1 px-4 py-2">

                <svg class="h-8 w-8 text-gray-300 group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none"></rect>
                    <path
                        d="M168.001,100.00017v.00341a12.00175,12.00175,0,1,1,0-.00341ZM232,56V200a16.01835,16.01835,0,0,1-16,16H40a16.01835,16.01835,0,0,1-16-16V56A16.01835,16.01835,0,0,1,40,40H216A16.01835,16.01835,0,0,1,232,56Zm-15.9917,108.6936L216,56H40v92.68575L76.68652,112.0002a16.01892,16.01892,0,0,1,22.62793,0L144.001,156.68685l20.68554-20.68658a16.01891,16.01891,0,0,1,22.62793,0Z">
                    </path>
                </svg> {{ $slot }}
            </div>
        </label>
    </div>
</div>
