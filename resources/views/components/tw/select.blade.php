@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'size' => 'md',
    'placeholder' => null,
    'helper' => null,
    'class' => null,
    'optinons' => null,
    'selected' => 0,
])
@php
    $options = json_decode($optinons);
@endphp
<div wire:ignore class="mt-2 mb-2 {{$class}}" >
    {{-- <select data-te-select-init {{$attributes}}    x-on:change="$wire.set('{{$name}}',$event.target.value)" id="{{$id}}" name="{{$name}}">
        @foreach ($options as $key => $option)
            <option value="{{$option}}" {{ $selected == $option ? 'selected' : '' }}>{{$option}}</option>
        @endforeach
    </select> --}}
    <x-select
    placeholder="{{ $label }}"
    :options="$options"
    wire:model.live="{{ $name }}"
/>
</div>

