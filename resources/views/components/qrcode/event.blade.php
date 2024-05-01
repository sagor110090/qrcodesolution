@props(['qrCode'=>null])

<div class="px-6 py-4 border-neutral-100 dark:border-neutral-500" x-show="type === 'event'" x-data x-cloak>
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <span class="mr-2 font-bold text-md">
            Event QR Code
        </span>
    </h5>
    <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-300 text-weight-300">

        <div class="flex items-center justify-center">
           <div class="col-span-1 mt-2">
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                    Event QR Code is a type of QR Code that is used to store information about an event. It can be used to store information about the event such as the event name, event date, event location, event description, and event website. You  will get event page or card when you scan this QR Code and it will provide a custom link to your event page.
                </p>
                @if (request()->routeIs('my-qrcode.edit'))
                    <x-ui.button type="primary"  size="md" submit="false"  tag="a" href="{{ route('my-qrcode.event.edit',$qrCode->subdomain) }}">
                        Edit Event QR Code
                    </x-ui.button>
                    @else
                    <x-ui.button type="primary"  size="md" submit="false"  tag="a" href="{{ route('event.create') }}">
                        Make Event QR Code
                    </x-ui.button>
                @endif

           </div>

        </div>

    </div>

</div>
