@props([
    'field' => '',
])
@error($field)
    <span class="grid justify-start text-red-500 text-xs italic">{{ $message }}</span>
@enderror
