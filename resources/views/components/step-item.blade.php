@props([
    'details' => null,
    'label' => null,
    'show' => false,
])

<li class="mb-10 ml-6" x-data="{ show: {{ $show }} }">
    <span
        class="absolute flex items-center justify-center w-8 h-8  rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-green-900" :class="{ 'bg-green-500' : show, 'bg-gray-200' : !show }">
        <svg class="w-3.5 h-3.5  dark:text-green-400" aria-hidden="true"
            :class="{ 'block' : show, 'hidden' : !show, 'text-green-400' : show, 'text-gray-400' : !show }"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
        </svg>
        {{ $icon ?? '' }}
    </span>
    <h3 class="font-medium leading-tight">
        {{ $label }}
    </h3>
    <p class="text-sm">
        {{ $details }}
    </p>
</li>
