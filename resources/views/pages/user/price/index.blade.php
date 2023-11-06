<?php

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state,usesPagination,with,on};
use App\Models\Plan;

name('price');

middleware(['auth', 'verified']);

with('plans', function() {
    return Plan::orderBy('price', 'asc')->get();
});

$subscribe = function ($plan_id) {
    $plan = Plan::where('plan_id', $plan_id)->first();
    $user = auth()->user();

    // if user have active subscription next time need to s


    return $user->newSubscription($plan->name, $plan->plan_id)
                ->allowPromotionCodes()
                // ->trialDays(31)
                ->checkout([
                    'success_url' => route('price'),
                    'cancel_url' => route('price'),
                ]);
};

?>


<x-layouts.app>

    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Price') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            @volt('price')
            <div class="container my-24 mx-auto md:px-6">
                <section class="mb-32">
                    <h2 class="mb-6 text-center text-3xl font-bold dark:text-white">Pricing</h2>

                    <p class="mb-12 text-center text-neutral-500 dark:text-neutral-300">
                        This is the best value for individuals!
                    </p>

                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 xl:gap-x-12">

                        <div class="mb-6 lg:mb-0">
                            <div
                                class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800 dark:text-white">
                                <div
                                    class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
                                    <p class="mb-4 text-sm uppercase">
                                        <strong>Free</strong>
                                    </p>
                                    <h3 class="mb-6 text-3xl">
                                        <strong>Free</strong>
                                    </h3>

                                    <button type="button"
                                        class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                        data-te-ripple-init data-te-ripple-color="light">
                                        Buy
                                    </button>
                                </div>
                                <div class="p-6">
                                    <ol class="list-inside">
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Unlimited
                                            updates
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        @foreach ($plans as $plan)
                        <div class="mb-6 lg:mb-0">
                            <div
                                class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800 dark:text-white">
                                <div
                                    class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
                                    <p class="mb-4 text-sm uppercase">
                                        <strong>{{$plan->name}}</strong>
                                    </p>
                                    <h3 class="mb-6 text-3xl">
                                        <strong class="text-primary-500 dark:text-primary-400">
                                            {{Support::currencyToSymbol($plan->currency)}} {{ $plan->price }}</strong>
                                        <small class="text-sm text-neutral-500 dark:text-neutral-300">/{{ $plan->interval }}</small>
                                    </h3>

                                    {{-- @dd(auth()->user()->subscribed()) --}}


                                    <button type="button"
                                        wire:click="subscribe('{{$plan->plan_id}}')"
                                        class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                        data-te-ripple-init data-te-ripple-color="light">
                                        Buy
                                    </button>
                                </div>
                                <div class="p-6">
                                    <ol class="list-inside">
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Unlimited Custom Links
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Unlimited Static QR Codes
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>  {{$plan->qrcode_limit}} Dynamic QR Codes
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Unlimited Scans per month
                                        </li>
                                        <div class="mt-4 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300 text-center">
                                            {!! $plan->description !!}
                                        </div>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        @endforeach



                        {{-- <div class="mb-6 lg:mb-0">
                            <div
                                class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800">
                                <div
                                    class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
                                    <p class="mb-4 text-sm uppercase">
                                        <strong>Hobby</strong>
                                    </p>
                                    <h3 class="mb-6 text-3xl">
                                        <strong>Free</strong>
                                    </h3>

                                    <button type="button"
                                        class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                        data-te-ripple-init data-te-ripple-color="light">
                                        Buy
                                    </button>
                                </div>
                                <div class="p-6">
                                    <ol class="list-inside">
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Unlimited
                                            updates
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6 lg:mb-0">
                            <div
                                class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800">
                                <div
                                    class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
                                    <p class="mb-4 text-sm uppercase">
                                        <strong>Basic</strong>
                                    </p>
                                    <h3 class="mb-6 text-3xl">
                                        <strong>$ 129</strong>
                                        <small class="text-sm text-neutral-500 dark:text-neutral-300">/year</small>
                                    </h3>

                                    <button type="button"
                                        class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                        data-te-ripple-init data-te-ripple-color="light">
                                        Buy
                                    </button>
                                </div>
                                <div class="p-6">
                                    <ol class="list-inside">
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Unlimited
                                            updates
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Git
                                            repository
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>npm
                                            installation
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6 lg:mb-0">
                            <div
                                class="block h-full rounded-lg border border-primary bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800">
                                <div
                                    class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
                                    <p class="mb-4 text-sm uppercase">
                                        <strong>Advanced</strong>
                                    </p>
                                    <h3 class="mb-6 text-3xl">
                                        <strong>$ 299</strong>
                                        <small class="text-sm text-neutral-500 dark:text-neutral-300">/year</small>
                                    </h3>

                                    <button type="button"
                                        class="inline-block w-full rounded bg-primary px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                        data-te-ripple-init data-te-ripple-color="light">
                                        Buy
                                    </button>
                                </div>
                                <div class="p-6">
                                    <ol class="list-inside">
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Unlimited
                                            updates
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Git
                                            repository
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>npm
                                            installation
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Code examples
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Premium
                                            snippets
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6 lg:mb-0">
                            <div
                                class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800">
                                <div
                                    class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
                                    <p class="mb-4 text-sm uppercase">
                                        <strong>Enterprise</strong>
                                    </p>
                                    <h3 class="mb-6 text-3xl">
                                        <strong>$ 499</strong>
                                        <small class="text-sm text-neutral-500 dark:text-neutral-300">/year</small>
                                    </h3>

                                    <button type="button"
                                        class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                        data-te-ripple-init data-te-ripple-color="light">
                                        Buy
                                    </button>
                                </div>
                                <div class="p-6">
                                    <ol class="list-inside">
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Unlimited
                                            updates
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Git
                                            repository
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>npm
                                            installation
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Code examples
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Premium
                                            snippets
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Premium
                                            support
                                        </li>
                                        <li class="mb-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor"
                                                class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>Drag&amp;Drop
                                            builder
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </section>
            </div>
            @endvolt
        </div>
    </div>

</x-layouts.app>
