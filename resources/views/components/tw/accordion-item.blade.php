@props([
    'label' => null,
    'id' => null,
    'show' => false,
])

<div class="border border-neutral-200 bg-white dark:bg-gray-900/50 dark:border dark:border-gray-200/10" wire:ignore>

    <h2 class="mb-0" id="heading{{$id}}">
        <button
            class="group relative flex w-full items-center border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none uppercase dark:bg-gray-900/50 dark:border dark:border-gray-200/10 dark:text-white border-gray-200/10"
            type="button" data-te-collapse-init data-te-target="#{{$id}}" aria-expanded="{{$show}}"
            aria-controls="{{$id}}">
           {{ $label }}
            <span
                class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </span>
        </button>
    </h2>
    <div id="{{$id}}" class="!visible {{ $show=='false' ? 'hidden' : ''}}" data-te-collapse-item {{ $show=='true' ? 'data-te-collapse-show' : '' }} aria-labelledby="heading{{$id}}">
        <div class="px-5 py-4">
           {{ $slot }}
        </div>
    </div>
</div>
