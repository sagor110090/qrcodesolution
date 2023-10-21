@props([
    'label' => null,
    'class' => '',
    'id' => null,
])

<div class="flex flex-col {{ $class }}" id="{{$id}}" wire:ignore x-cloak>
    {{ $slot }}
  </div>
