@props([
    'label' => null,
    'id' => null,
    'show' => false,
])

<div class="bg-white border border-neutral-200 dark:bg-gray-900/50 dark:border dark:border-gray-200/10"
    x-data='{ open: false }' x-on:click="open = ! open">

    <h2 class="mb-0" id="heading{{$id}}">
        <button
            class="group relative flex w-full items-center border-0 bg-white px-5 py-4 text-left text-base text-neutral-800  [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none uppercase dark:bg-gray-900/50 dark:border dark:border-gray-200/10 dark:text-white border-gray-200/10"
            type="button">
           {{ $label }}
                <div x-text="open ? '-' : '+'" class="ml-auto text-2xl font-bold">
                </div>
        </button>
    </h2>
    <div id="{{$id}}" class="border-t border-neutral-200" x-show="open" x-on:click="open = false"  >
        <div class="px-5 py-4">
           {{ $slot }}
        </div>
    </div>
</div>
