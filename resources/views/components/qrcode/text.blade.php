<div class="border-neutral-100 px-6 py-4 dark:border-neutral-500" x-show="type === 'text'" x-data x-cloak>
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
            Text QR Code
        </x-tw.label>
    </h5>
    <div class="mt-2 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300">

        <div class="grid grid-cols-1 gap-4">
           <x-tw.textarea label="Text" placeholder="Text" id="text"  required class="col-span-2" name="text_data"/>
        </div>

    </div>

</div>
