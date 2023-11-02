@props([
'class' => '',
])


<div class="bg-white shadow  dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10 {{ $class }}">
    <div class="px-2 py-4">

        <p class="mb-2 text-base text-neutral-500 dark:text-neutral-300">
            {{ $slot }}
        </p>



    </div>

</div>
