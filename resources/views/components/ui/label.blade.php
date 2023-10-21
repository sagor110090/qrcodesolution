@props([
    'value' => null,
    'for' => null,
    'class' => null,
])

@php $wireModel = $attributes->get('wire:model'); @endphp

@if($value)
<label for="{{ $for ?? '' }}" class="block text-sm font-medium text-gray-700 dark:text-gray-400 {{ $class ?? '' }}">
    {{ $value  }}
</label>
@endif
