@props([
    'bitcoin_address' => '',
    'bitcoin_amount' => '',

])

<div class="px-6 py-4 border-neutral-100 dark:border-neutral-500" x-show="type === 'bitcoin'" x-data x-cloak>
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <span class="mr-2 font-bold text-md">
            Bitcoin QR Code
        </span>
    </h5>
    <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-300 text-weight-300">
           <x-tw.input label="Bitcoin Address" placeholder="Bitcoin Address" id="bitcoin"  required class="col-span-2" name="bitcoin_address" value="{{ $bitcoin_address }}"/>
           <x-tw.input label="Amount"  id="amount" type="number" step="0.01" min="0" required class="col-span-2" name="bitcoin_amount" value="{{ $bitcoin_amount }}"/>

    </div>

</div>
