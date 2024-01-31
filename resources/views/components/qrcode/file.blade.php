@props([
    'file' => null,
])

<div class="border-neutral-100 px-6 py-4 dark:border-neutral-500" x-show="type === 'video'">
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
           File QR Code 
        </x-tw.label>
    </h5>
    <div class="mt-2 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300">

        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2 text-center text-neutral-500 dark:text-neutral-300 text-weight-300">

                <livewire:file-uploader :name="'video'" :accept="'file/*'" :text="'Upload File'"
                    :rules="[ 'file', 'max:100024','mimes:pdf,docx,zip' ]" :loadFileName="$file" />
                @error('video') <span class="text-red-500 mt-1 text-sm">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

</div>
