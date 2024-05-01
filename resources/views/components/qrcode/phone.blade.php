<div class="border-neutral-100 px-6 py-4 dark:border-neutral-500" x-show="type === 'phone'" x-data x-cloak>
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
            Phone QR Code / Call QR Code
        </x-tw.label>
    </h5>

        <div class="mt-2 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300">
            <x-tw.input label="Phone Number"  id="link"  style="height: 50px; width: 100%; "  type="tell" size="lg" name="call_phone"
            helper="Ex: +8801712345678"
            />
         </div>


</div>
