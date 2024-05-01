@props([
    'label' => null,
    'class' => '',
    'id' => null,
])

<div class="flex flex-col {{ $class }}" id="{{$id}}">
    {{ $slot }}
  </div>
