<div class="grid grid-cols-12 gap-4">
    <div class="col-span-6 md:col-span-2 mt-5">
        <x-tw.button-select @click="qr_logo = '',qr_custom_logo=null" value=""
            type="qr_logo">
            <svg viewBox="0 0 16 16" class="bi bi-x w-10 h-10 rounded-lg shadow-lg"
                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                </path>
            </svg>
        </x-tw.button-select>
    </div>
    @foreach (Support::readFolder(public_path('images/watermarks')) as $item)
    <div class="col-span-6 md:col-span-2 mt-5">
        <x-tw.button-select @click="qr_logo = '{{ $item }}'" value="{{ $item }}"
            type="qr_logo">
            <img src="{{ asset('images/watermarks/' . $item) }}" alt="{{ $item }}"
                class="w-10 h-10 rounded-lg shadow-lg">
        </x-tw.button-select>

    </div>
    @endforeach


</div>
<div class="col-span-12 md:col-span-4 mt-5">
    <x-tw.file-attachment name="qr_custom_logo" profile-class="w-24 h-24 rounded-lg"
        accept="image/jpg,image/jpeg,image/png">
        <span class="ml-2 text-gray-600">Upload logo | <span class="text-sm">PNG or
                JPEG</span></span>
    </x-tw.file-attachment>
</div>
<div class="col-span-12 md:col-span-4 mt-5">
    <x-tw.switch label="Remove background behind Logo" name="qr_logo_background" />
</div>
