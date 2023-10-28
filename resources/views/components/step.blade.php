@props([
    'label' => null,
    'class' => '',
    'id' => null,
])

<div class="grid grid-cols-12 gap-2">
    <div class="col-span-12 md:col-span-8">
        <ol class="relative text-gray-500 border-l border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <x-step-item label="Personal Info" details="Step details here" show="false">
                <x-slot name="icon">
                    <svg class="w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                </x-slot>
            </x-step-item>
        </ol>
    </div>
    <div class="col-span-12 md:col-span-4">
       <x-tw.input label="First Name" name="first_name" id="first_name" placeholder="First Name" class="w-full" />

    </div>

</div>
