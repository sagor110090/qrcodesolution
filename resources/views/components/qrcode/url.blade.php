@props([
    'url' => '',
])

<div class="px-6 py-4 border-neutral-100 dark:border-neutral-500" x-show="type === 'url'"  >
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
            Enter your websiite URL
        </x-tw.label>
    </h5>
    <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-300 text-weight-300">
       <x-tw.input label="Website (URL)" placeholder="https://qrcodesolution.com" id="link"  style="height: 50px; width: 100%; "  type="link" size="lg"
       helper="Ex: https://qrcodesolution.com"
       name="url" value="{{ $url ?: 'https://' }}"
       />

    </div>

</div>
