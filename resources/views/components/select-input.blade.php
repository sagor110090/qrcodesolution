@props([
    'label' => null,
    'placeholder' => null,
    'options' => [],
    'icon' => null,
    'prepend' => null,
    'append' => null,
    'size' => null,
    'help' => null,
    'model' => null,
    'lazy' => false,
])


@props(['disabled' => false])




<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-1 w-full rounded-md form-input focus:border-indigo-600']) !!}>
    <option value="">{{ $placeholder ?? 'Select an option' }}</option>
    @foreach ($options as $value => $option)
        <option value="{{ $value }}" {{ $isSelected($value) ? 'selected' : '' }}>
            {{ $option }}
        </option>
    @endforeach
</select>

