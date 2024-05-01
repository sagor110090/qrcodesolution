@props([
    'latitude' => '',
    'longitude' => '',
])

<div class="px-6 py-4 border-neutral-100 dark:border-neutral-500" x-show="type === 'location'" x-data x-cloak>
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
            Location QR Code
        </x-tw.label>
    </h5>
    <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-300 text-weight-300">
           <x-tw.input label="Latitude" placeholder="Latitude" id="latitude"  required class="col-span-2" name="latitude" type="number" step="0.00000001" min="-90" max="90" value="{{ $latitude }}"/>
           <x-tw.input label="Longitude" placeholder="Longitude" id="longitude"  required class="col-span-2" name="longitude" type="number" step="0.00000001" min="-180" max="180" value="{{ $longitude }}"/>

    </div>

</div>
