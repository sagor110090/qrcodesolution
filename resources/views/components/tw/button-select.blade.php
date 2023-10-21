@props([
    'class' => '',
    'type' => 'type',
    'value' => null,
])

<div class="cursor-pointer" {{ $attributes }}>
    <div class="border border-indigo-600 flex items-center justify-center bg-gradient-to-br rounded-lg p-2   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100 {{ $class }}" :class="{'border-indigo-600': {{$type}} === '{{ $value }}' }"
    x-on:click="$wire.set('{{$type}}',$event.target.value)"
    >
        {{ $slot }}
    </div>
</div>
