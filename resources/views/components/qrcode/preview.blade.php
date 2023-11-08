@props(['edit' => false])

<div class="p-0 grid  justify-center">
    <div class=" max-w-[18rem] rounded-lgdark:bg-neutral-700 grid justify-items-center">
        <div class="relative overflow-hidden bg-cover bg-no-repeat">

            <div class="border-2 shadow-sm w-48 h-48 rounded-lg border-gray-200 dark:border-gray-700">
                @if (!$edit)
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-gray-200 to-gray-200 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 rounded-lg border-2 border-gray-200 dark:border-gray-700"
                        x-show='dynamic' x-transition>
                        <div
                            class="flex items-center justify-center h-full text-center text-gray-500 dark:text-gray-300">
                            Save your QR code to download and use it.
                        </div>
                    </div>
                @endif

                <div x-html="qrcodePreview" id="qrcodePreview" x-transition>
                </div>
                <img src="{{ asset('images/placeholder.svg') }}" x-show='!qrcodePreview && !dynamic' x-transition
                    alt="placeholder" class="w-48 h-48 rounded-lg">

            </div>
        </div>
        <div class="p-0">
            <p class="text-base text-neutral-600 dark:text-neutral-200">
                Scan me to get the link
            </p>
        </div>
        <div class="grid grid-cols-3 gap-4 p-2">
            <x-tw.button-select @click="imageType = 'png'" value="png" type="imageType">
                PNG
            </x-tw.button-select>
            <x-tw.button-select @click="imageType = 'jpeg'" value="jpeg" type="imageType">
                JPEG
            </x-tw.button-select>
            <x-tw.button-select @click="imageType = 'svg'" value="svg" type="imageType">
                SVG
            </x-tw.button-select>

        </div>
    </div>
    <div class="mt-4 p-2 grid grid-cols-2 gap-4">
        <a href="javascript:void(0)" @click="download()"
            class="flex items-center justify-center bg-gradient-to-br rounded-lg p-2   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            <span class="ml-2 font-bold text-md">
                Download
            </span>
        </a>


        <a href="javascript:void(0)" wire:click="save()"
            class="flex items-center justify-center bg-gradient-to-br rounded-lg p-2   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            <span class="ml-2 font-bold text-md">
                Save
                <div wire:loading>
                    <x-spinner class="w-6 h-6 text-gray-500" />
                </div>
            </span>
        </a>


    </div>

</div>
