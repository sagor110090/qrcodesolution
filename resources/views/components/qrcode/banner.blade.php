<!-- Section: Design Block -->
<section class="mb-12">
    <div  {{ $attributes->merge(['class' => 'alert alert-dismissible fade show items-center justify-between rounded-lg  py-4 px-6 text-center text-white md:flex md:text-left']) }}
    >
        <div class="mb-4 flex flex-wrap items-center justify-center md:mb-0 md:justify-start">

            {{ $slot }}
        </div>
        <div class="flex items-center justify-center">
            {{ $button ?? '' }}
        </div>
    </div>
</section>
<!-- Section: Design Block -->
