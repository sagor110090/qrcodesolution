@props([
    'audio' => null,
])

<div class="border-neutral-100 px-6 py-4 dark:border-neutral-500" x-show="type === 'audio'">
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <span class="mr-2 font-bold text-md">
            Audio QR Code
        </span>
    </h5>
    <div class="mt-2 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300">

        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2 text-center text-neutral-500 dark:text-neutral-300 text-weight-300">

                <livewire:file-uploader :name="'audio'" :accept="'audio/*'" :text="'Upload Audio'"
                    :rules="[ 'file', 'max:10024','mimes:mpga,mp3' ]" :loadFileName="$audio" />
                @error('audio') <span class="text-red-500 mt-1 text-sm">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

</div>
