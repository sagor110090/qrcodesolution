@props([
    'label' => null,
    'class' => '',
])


<h6 class="text-lg font-medium leading-tight  text-neutral-800 dark:text-neutral-300 {{ $class }}">
    {{$slot}}
</h6>
