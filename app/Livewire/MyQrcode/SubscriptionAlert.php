<?php

namespace App\Livewire\MyQrcode;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class SubscriptionAlert extends ModalComponent
{
    public function render()
    {
        return <<<'HTML'
        <div>
            <div class='flex items-center justify-center'>
                <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800 dark:border dark:border-gray-200/10'>
                    <h3>
                        <div class='flex items-end justify-end pb-3'>
                            <button wire:click="$dispatch('closeModal')" class='text-gray-400 hover:text-gray-500 dark:text-gray-300 dark:hover:text-gray-400'>
                                <svg class='w-6 h-6 fill-current' viewBox='0 0 24 24'>
                                    <path
                                        d='M19.41 7.41L18 6l-6 6-6-6L4.59 7.41 12
                                    15.01l7.41-7.42z' />
                                </svg>
                            </button>
                        </div>
                    </h3>
                    <div class='max-w-md mx-auto space-y-6'>
                        <h1 class='font-semibold text-center text-gray-800 dark:text-gray-200'>
                            Your subscription has been expired. Please renew your subscription to continue using our services.
                        </h1>
                        <div class='flex items-center justify-center gap-2'>
                            <x-button sm icon="credit-card" primary wire:click="$dispatch('closeModal')" href="{{ route('price') }}" wire:navigate>Subscription</x-button>
                            <x-button sm icon="x" wire:click="$dispatch('closeModal')" negative>Cancel</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }
}
