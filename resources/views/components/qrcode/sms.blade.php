<div class="px-6 py-4 border-neutral-100 dark:border-neutral-500" x-show="type === 'sms'">
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
            SMS QR Code
        </x-tw.label>
    </h5>
    <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-300 text-weight-300">

        <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-300 text-weight-300">
            <x-tw.input label="Phone Number"  id="phone_number" type="tell" name="sms_phone"
            helper="Ex: +8801712345678"
            />
            <x-tw.textarea label="Message" placeholder="Message" id="message"  required class="col-span-2" name="sms"/>

         </div>


    </div>

</div>
