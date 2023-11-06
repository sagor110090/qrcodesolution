<div>
    <div class='flex items-center justify-center'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
            <h3>
                <div class='flex items-center justify-between'>
                    <span class='text-2xl font-bold text-gray-900'>Create Plan </span>
                    <button wire:click="$dispatch('closeModal')" class='text-gray-400 hover:text-gray-500'>
                        <svg class='w-6 h-6 fill-current' viewBox='0 0 24 24'>
                            <path d='M19.41 7.41L18 6l-6 6-6-6L4.59 7.41 12
                             15.01l7.41-7.42z' />
                        </svg>
                    </button>
                </div>
            </h3>
            <div class='max-w-md mx-auto space-y-6'>
                <form method="post" class="mt-6 space-y-6" wire:submit="store">
                    <div>
                        <x-input label="Name" placeholder="Plan name" wire:model.live="name" :value="old('name')"
                            autofocus autocomplete="name" />
                    </div>
                    <div>
                        <x-input label="Price" placeholder="Plan price" wire:model.live="price" :value="old('price')"
                            autofocus autocomplete="price" type="number" step="0.01"/>
                    </div>
                    <div>
                            <x-select
                            label="Currency"
                            placeholder="Plan currency"
                            wire:model.live="currency"
                            :options="[
                                 ['name' => 'USD', 'id' => 'usd'],
                                ['name' => 'EUR', 'id' => 'eur'],
                                ['name' => 'GBP', 'id' => 'gbp'],
                            ]"
                            option-label="name"
                            option-value="id"
                        />
                    </div>
                    <div>
                        <x-select label="Interval" placeholder="Plan interval" wire:model.live="interval"
                            :options="[
                                ['name' => 'Day', 'id' => 'day'],
                                ['name' => 'Week', 'id' => 'week'],
                                ['name' => 'Month', 'id' => 'month'],
                                ['name' => 'Year', 'id' => 'year'],
                            ]"
                             option-label="name"
                             option-value="id"
                            autofocus autocomplete="interval" />
                    </div>
                    <div>
                        <x-textarea wire:model="description" label="Description" placeholder="Plan description"
                            :value="old('description')" autofocus autocomplete="description" />

                    </div>
                    <div>
                        <x-input label="QR Code Limit" placeholder="QR Code Limit" wire:model.live="qrcode_limit"
                            :value="old('qrcode_limit')" autofocus autocomplete="qrcode_limit" type="number"/>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
