@props([
    'network_name' => '',
    'network_password' => '',
    'network_type' => '',
    'wifi_hidden' => '',
])

<div class="border-neutral-100 px-6 py-4 dark:border-neutral-500" x-show="type === 'wifi'">
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
            Wifi QR Code
        </x-tw.label>
    </h5>
    <div class="mt-2 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300">

        <x-tw.input label="SSID" id="ssid" type="text"  helper="Ex: MyWifi" name="network_name"
            class="col-span-2" value="{{ $network_name }}" />
        <x-tw.checkbox label="Hidden" id="hidden" value="true" class="col-span-2 w-10" name="wifi_hidden"  value="{{ $wifi_hidden }}"/>
        <x-tw.input label="Password" id="password" type="text"  helper="Ex: 12345678"
            class="col-span-2 mt-2" name="network_password" value="{{ $network_password }}" />
        <x-tw.select wire:ignore label="Encryption" id="encryption"  class="col-span-2 mt-4" :optinons="json_encode(['WPA', 'WEP'])" name="network_type" value="{{ $network_type }}"/>

    </div>

</div>
