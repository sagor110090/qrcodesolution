@props([
    'image' => null,
])
<div class="px-6 py-4 border-neutral-100 dark:border-neutral-500" x-show="type === 'image'">
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
            Image QR Code
        </x-tw.label>
    </h5>
    <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-300 text-weight-300">

        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2 text-center text-neutral-500 dark:text-neutral-300 text-weight-300">

                <livewire:file-uploader :name="'image'" :accept="'image/*'" :text="'Upload Image'"
                    :rules="[ 'image', 'max:10024','mimes:jepg,png,jpg' ]" :loadFileName="$image" />
                @error('image') <span class="mt-1 text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

</div>
