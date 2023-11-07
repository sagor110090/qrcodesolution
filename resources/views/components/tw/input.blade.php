@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'size' => 'md',
    'placeholder' => null,
    'helper' => null,
    'class' => null,
    'value' => '',
])
<div class="mt-2">
    @if ($size == 'lg')
        {{-- <div class="relative {{ $class }}" data-te-input-wrapper-init wire:ignore>
            <input type="{{ $type }}" x-on:input.change="$wire.set('{{$name}}',$event.target.value)"
                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                placeholder="{{ $placeholder }}" {{ $attributes }}
                value='{{ $value }}'

                />
            <label for="{{ $id }}"
                class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">{{ $label }}
            </label>
            @if ($helper)
                <p class="text-xs text-neutral-500 dark:text-neutral-300 float-right italic ">{{ $helper }}</p>
            @endif
        </div> --}}
        <x-input label="{{ $label }}" placeholder="{{ $label }}" id="{{ $id }}" type="{{ $type }}" size="{{ $size }}" helper="{{ $helper }}" wire:model.live="{{ $name }}" class="{{ $class }}" {{ $attributes }}  hi/>

    @endif

    @if ($size == 'md')
        {{-- <div class="relative {{ $class }}" data-te-input-wrapper-init wire:ignore>

            <input type="{{ $type }}" x-on:input.change="$wire.set('{{$name}}',$event.target.value)"
                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                id="{{ $id }}" placeholder="{{ $placeholder }}" {{ $attributes }}
                value='{{ $value }}'
                />
            <label for="{{ $id }}"
                class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                >{{ $label }}
            </label>
        </div> --}}
        <x-input  placeholder="{{ $label }}" id="{{ $id }}" type="{{ $type }}" size="{{ $size }}" helper="{{ $helper }}" wire:model.live="{{ $name }}" class="{{ $class }}" {{ $attributes }}  />
    @endif

    @if ($size == 'sm')
        {{-- <div class="relative" data-te-input-wrapper-init wire:ignore>
            <input type="{{ $type }}" x-on:input.change="$wire.set('{{$name}}',$event.target.value)"
                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.33rem] text-xs leading-[1.5] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                id="{{ $id }}" placeholder="{{ $placeholder }}" {{ $attributes }}
                value='{{ $value }}'
                />
            <label for="{{ $id }}"
                class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] text-xs leading-[1.5] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.75rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.75rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">{{ $label }}
            </label>
        </div> --}}
        <x-input  placeholder="{{ $label }}" id="{{ $id }}" type="{{ $type }}" size="{{ $size }}" helper="{{ $helper }}" wire:model.live="{{ $name }}" class="{{ $class }}" {{ $attributes }}  />
    @endif
    {{-- <x-tw.error :field="$name" /> --}}

</div>
