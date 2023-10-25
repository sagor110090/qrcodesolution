<div class="col-span-12 md:col-span-8 mt-5">
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-6 md:col-span-2 mt-5">
            <x-tw.button-select @click="qr_bg_image = '',qr_custom_background=''"
                value="" type="qr_bg_image">
                <svg viewBox="0 0 16 16" class="bi bi-x w-10 h-10 rounded-lg shadow-lg"
                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                    </path>
                </svg>
            </x-tw.button-select>
        </div>
        @foreach (Support::readFolder(public_path('images/animated-images')) as $item)
        <div class="col-span-6 md:col-span-2 mt-5">
            <x-tw.button-select @click="qr_bg_image = '{{ $item }}'" value="{{ $item }}"
                type="qr_bg_image">
                <img src="{{ asset('images/animated-images/' . $item) }}"
                    alt="{{ $item }}" class="w-10 h-10 rounded-lg shadow-lg">
            </x-tw.button-select>
        </div>
        @endforeach


    </div>
</div>
<div class="col-span-12 md:col-span-4 mt-5">
    <x-tw.file-attachment name="qr_custom_background"
        profile-class="w-24 h-24 rounded-lg" accept="image/jpg,image/jpeg,image/png">
        <span class="ml-2 text-gray-600">Upload logo | <span class="text-sm">PNG or
                JPEG</span></span>
    </x-tw.file-attachment>
</div>
