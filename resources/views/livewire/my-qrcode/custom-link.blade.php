<div>
    <div class='flex items-center justify-center'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800'>
            <h3>
                <div class='flex items-center justify-between'>
                    <span class='text-xl  text-gray-900 dark:text-gray-100'>
                        Custom Link For QR Code
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
                <form wire:submit.prevent="submit">
                    <div class="mt-4 mb-4">
                        <x-input class="pr-28"  placeholder="Custom Link" suffix=".qrcodesolution.com"
                            wire:model="link" />
                    </div>
                    <x-button primary label="Submit" wire:click="submit" />
                </form>

            </div>
        </div>
    </div>
</div>
