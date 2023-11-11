@props([
    'icons' => [],
    'name' => 'select',
])
<div class="mt-3 relative" {{ $attributes }}>
    <div class="relative mt-2" x-data="{ open: false, select: field.link_icon}"
    x-init="$watch('select', value => { $dispatch('input', value) })"
    @click.away="open = false" @close.stop="open = false">
        <button type="button"
            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6 dark:bg-secondary-800 dark:text-gray-300 dark:ring-gray-600 "
            aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label" @click="open = !open"
            x-bind:aria-expanded="open">
            <span class="block truncate text-gray-900 dark:text-secondary-400" x-text="select" v-show="select">
            </span>
            <span class="block truncate text-gray-900 dark:text-secondary-400" x-show="!select">
                Select Social Icon</span>
            <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </button>

        <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm dark:bg-secondary-800 dark:text-gray-300 dark:ring-gray-600"
            tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3"
            x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="open = false">

            @foreach ($icons as $key => $item)
                <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9 dark:bg-secondary-800 dark:text-gray-300 dark:ring-gray-600"
                    id="listbox-option-0" role="option" @click="select = '{{ $key }}'; open = false">
                    <div class="flex items-center">
                        <div>
                            {!! $item !!}
                        </div>

                        <span class="font-normal ml-3 block truncate">
                            {{ $key }}
                        </span>
                    </div>


                    <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4" x-show="select == '{{ $key }}'">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            @endforeach


        </ul>
    </div>
</div>
