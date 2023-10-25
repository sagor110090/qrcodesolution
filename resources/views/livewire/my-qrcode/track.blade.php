<div>

    <div class='flex items-center justify-center'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800'>
            <h3>
                <div class='flex items-center justify-between'>
                    <span class='text-2xl font-bold text-gray-900 dark:text-gray-100'>
                        Track QR Code
                    </span>
                    <button wire:click="$dispatch('closeModal')" class='text-gray-400 hover:text-gray-500'>
                        <svg class='w-6 h-6 fill-current' viewBox='0 0 24 24'>
                            <path
                                d='M19.41 7.41L18 6l-6 6-6-6L4.59 7.41 12
                             15.01l7.41-7.42z' />
                        </svg>
                    </button>
                </div>
            </h3>
            <div class='max-w-md mx-auto space-y-6'>
                @forelse ($locations as $location)
                <x-tw.card class="mt-1">
                    @php
                        $location = (object) $location;
                    @endphp
                    <p class="text-md text-gray-600 dark:text-gray-200">
                        <span class="font-bold">IP Address:</span> {{ $location->ip_address }}
                    </p>
                    <p class="text-md text-gray-600 dark:text-gray-200">
                        <span class="font-bold">City:</span> {{ $location->city }}
                    </p>
                    <p class="text-md text-gray-600 dark:text-gray-200">
                        <span class="font-bold">Country:</span> {{ $location->country }}
                    </p>
                    <p class="text-md text-gray-600 dark:text-gray-200">
                        <span class="font-bold">Region:</span> {{ $location->region }}
                    </p>
                    <p class="text-md text-gray-600 dark:text-gray-200">
                        <span class="font-bold">Zip Code:</span> {{ $location->zip_code }}
                    </p>
                    <p class="text-md text-gray-600 dark:text-gray-200">
                        <span class="font-bold">Latitude:</span> {{ $location->latitude }}
                    </p>
                    <p class="text-md text-gray-600 dark:text-gray-200">
                        <span class="font-bold">Longitude:</span> {{ $location->longitude }}
                    </p>

                    {{-- scan at  --}}
                    <p class="text-md text-gray-600 dark:text-gray-200">
                        <span class="font-bold">Scanned at:</span> {{ $location->created_at }}
                    </p>


                </x-tw.card>
                @empty

                {{-- empty --}}
                <x-tw.card class="mt-1">
                    <p class="text-md text-gray-600 dark:text-gray-200">
                        <span class="font-bold">No location found</span>
                    </p>
                </x-tw.card>

                @endforelse

            </div>
        </div>
    </div>
</div>
