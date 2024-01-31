@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'size' => 'md',
    'placeholder' => null,
    'helper' => null,
    'class' => null,
    'value' => '',
])
<div class="mt-2">

    @if ($type == 'color')
            <x-color-picker
                placeholder="{{ $label }}"
                wire:model.live.debounce.250ms="{{ $name }}"
            />
    @else

        @if ($size == 'lg')
            <x-input label="{{ $label }}" placeholder="{{ $label }}" id="{{ $id }}" type="{{ $type }}" size="{{ $size }}" helper="{{ $helper }}" wire:model.live.debounce.250ms="{{ $name }}" class="{{ $class }}" {{ $attributes }}  hi/>

        @endif

        @if ($size == 'md')
            <x-input  placeholder="{{ $label }}" id="{{ $id }}" type="{{ $type }}" size="{{ $size }}" helper="{{ $helper }}" wire:model.live.debounce.250ms="{{ $name }}" class="{{ $class }}" {{ $attributes }}  />
        @endif

        @if ($size == 'sm')
            <x-input  placeholder="{{ $label }}" id="{{ $id }}" type="{{ $type }}" size="{{ $size }}" helper="{{ $helper }}" wire:model.live.debounce.250ms="{{ $name }}" class="{{ $class }}" {{ $attributes }}  />
        @endif

    @endif

</div>
