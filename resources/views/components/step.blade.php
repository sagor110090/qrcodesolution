@props([
    'label' => null,
    'class' => '',
    'id' => null,
    'steps' => [],
])

<div class="grid grid-cols-12 gap-2">
    <div class="col-span-12 md:col-span-4">
        <ol class="relative text-gray-500 border-l border-gray-200 dark:border-gray-700 dark:text-gray-400">
            @foreach ($steps as $step)
                <x-step-item label="{{ $step['name'] }}" details="{{ $step['details'] }}" icon="{{ $step['icon'] }}">

                </x-step-item>
            @endforeach

        </ol>
    </div>
    <div class="col-span-12 md:col-span-8">

        {{ $details ?? '' }}

    </div>

</div>
