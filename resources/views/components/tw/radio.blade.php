@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'placeholder' => null,
    'class' => null,
    'value' => null,
])


<div class="mb-[0.125rem] mr-4 inline-block min-h-[1.5rem] pl-[1.5rem] {{ $class }}">
    <x-radio   lg wire:model.live="{{ $name }}" value="{{ $value }}" label="{{$label}}" {{ $attributes }} id="{{ $id }}" />
</div>
