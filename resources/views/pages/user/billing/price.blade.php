<?php

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, usesPagination, with, on,placeholder};
use App\Models\Plan;

name('price');

middleware(['auth', 'verified']);

with('plans', function () {
    return Plan::orderBy('price', 'asc')->get();
});

$subscribe = function ($plan_id) {
    $plan = Plan::where('plan_id', $plan_id)->first();
    $user = auth()->user();


    //user active subscription
    $userSubscription = $user
        ->subscriptions()
        ->active()
        ->first();

    if ($userSubscription && $userSubscription->stripe_status == 'active') {
        $user->subscription($userSubscription->name)->cancelNow();
    }

    //new client subscription
    $user->createOrGetStripeCustomer();

    return $user
        ->newSubscription($plan->name, $plan->plan_id)
        ->allowPromotionCodes()
        // ->trialDays(31)
        ->checkout([
            'success_url' => route('price',['success' => 'true']),
            'cancel_url' => route('price'),
        ]);
};

$cancel = function ($plan_id) {
    $plan = Plan::where('plan_id', $plan_id)->first();
    $user = auth()->user();

    $user->subscription($plan->name)->cancelNow();

    $this->dispatch('toast', message: 'Subscription canceled.', data: ['position' => 'top-right', 'type' => 'success']);
};




?>


<x-layouts.app>

    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Price') }}
        </h2>
    </x-slot>

    @push('css')
        <style>
            .hiddenBanner {
                display: none;
            }
        </style>
    @endpush

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            @volt('price')
                <div class="container my-24 mx-auto md:px-6">
                    <x-qrcode.banner class="bg-green-500 {{request()->success ? '' : 'hiddenBanner'}}">
                        <span class="mr-2 [&>svg]:h-5 [&>svg]:w-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                            </svg>
                        </span>
                        <strong class="mr-1"> Congratulations </strong>
                        <span class="text-sm text-white">Your subscription was successful. Please continue using our services.</span>
                    </x-qrcode.banner>
                    <section class="mb-32">
                        <h2 class="mb-6 text-center text-3xl font-bold dark:text-white">Pricing</h2>

                        <p class="mb-12 text-center text-neutral-500 dark:text-neutral-300">
                            This is the best value for individuals!
                        </p>


                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 xl:gap-x-12">

                            <div class="mb-6 lg:mb-0">
                                <div
                                    class="block h-full rounded-lg bg-white rounded-lg  shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800 dark:text-white">
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
                                            Free
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
                                <div class="mb-6 lg:mb-0" >
                                    <div
                                        class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800 dark:text-white {{ auth()->user()->subscribed($plan->name) ? 'border border-primary' : '' }}">
                                        <div
                                            class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
                                            <p class="mb-4 text-sm uppercase">
                                                <strong>{{ $plan->name }}</strong>
                                            </p>
                                            <h3 class="mb-6 text-3xl">
                                                <strong class="text-primary-500 dark:text-primary-400">
                                                    {{ Support::currencyToSymbol($plan->currency) }}
                                                    {{ $plan->price }}</strong>
                                                <small
                                                    class="text-sm text-neutral-500 dark:text-neutral-300">/{{ $plan->interval }}</small>
                                            </h3>

                                            @if (auth()->user()->subscribed($plan->name))
                                                <button type="button" wire:click="cancel('{{ $plan->plan_id }}')"
                                                    class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                                    data-te-ripple-init data-te-ripple-color="light">
                                                    Cancel
                                                </button>
                                            @else
                                                <button type="button" wire:click="subscribe('{{ $plan->plan_id }}')"
                                                    class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                                    data-te-ripple-init data-te-ripple-color="light">
                                                    Buy
                                                </button>
                                            @endif


                                        </div>
                                        <div class="p-6">
                                            <ol class="list-inside">
                                                <li class="mb-4 flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M4.5 12.75l6 6 9-13.5" />
                                                    </svg>Unlimited Custom Links
                                                </li>
                                                <li class="mb-4 flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M4.5 12.75l6 6 9-13.5" />
                                                    </svg>Unlimited Static QR Codes
                                                </li>
                                                <li class="mb-4 flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M4.5 12.75l6 6 9-13.5" />
                                                    </svg> {{ $plan->qrcode_limit }} Dynamic QR Codes
                                                </li>
                                                <li class="mb-4 flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M4.5 12.75l6 6 9-13.5" />
                                                    </svg>Unlimited Scans per month
                                                </li>
                                                <div
                                                    class="mt-4 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300 text-center">
                                                    {!! $plan->description !!}
                                                </div>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            @endvolt
        </div>
    </div>

</x-layouts.app>
