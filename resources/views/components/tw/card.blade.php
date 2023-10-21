@props([
'class' => '',
])


<div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-left {{ $class }}">
    <div class="px-2 py-4">

        <p class="mb-2 text-base text-neutral-500 dark:text-neutral-300">
            {{ $slot }}
        </p>



    </div>

</div>
