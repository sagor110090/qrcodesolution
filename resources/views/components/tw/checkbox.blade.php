@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'size' => 'md',
    'placeholder' => null,
    'helper' => null,
    'class' => null,
    'value' => 0,
])
<div class="mt-2">
      <x-toggle wire:model.live="{{ $name }}"  left-label="{{ $label }}"   />
</div>

