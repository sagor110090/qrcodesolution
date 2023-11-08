@props([
    'icon' => 'bi bi-link-45deg',
    'name' => 'URL',
])

<div class="flex flex-col" {{ $attributes }} >
    <div class="flex items-center justify-center bg-gradient-to-br rounded-lg p-3   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600" :class="{ 'border border-sky-500': type === '{{ strtolower($name) }}' }">
        {{-- <i class="{{$icon}} text-xl"></i> --}}
        {{ $icon ?? ''}}
    </div>
    <div class="mt-2 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300 font-bold">
        {{ $name }}
    </div>
</div>
