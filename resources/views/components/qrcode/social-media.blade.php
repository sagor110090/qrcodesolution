@props(['qrCode'=>null])

<div class="border-neutral-100 px-6 py-4 dark:border-neutral-500" x-show="type === 'social'" x-data x-cloak>
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <span class="mr-2 font-bold text-md">
            Social Media QR Code
        </span>
    </h5>
    <div class="mt-2 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300">

        <div class="flex items-center justify-center">
           <div class="col-span-1 mt-2">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                    Social Media QR Code is a type of QR Code that is used to store information about your social media accounts. It can be used to store information about your social media accounts such as Facebook, Twitter, Instagram, LinkedIn, Youtube, and many more. You  will get a social media page or card when you scan this QR Code and it will provide a custom link to your social media page.
                </p>
                @if (request()->routeIs('my-qrcode.edit'))
                    <x-ui.button type="primary"  size="md" submit="false"  tag="a" href="{{ route('my-qrcode.social.edit',['qrCode' => $qrCode]) }}">
                        Edit Social Media QR Code
                    </x-ui.button>
                    @else
                    <x-ui.button type="primary"  size="md" submit="false"  tag="a" href="{{ route('social.create') }}">
                        Make Social Media QR Code
                    </x-ui.button>
                @endif

           </div>

        </div>

    </div>

</div>
