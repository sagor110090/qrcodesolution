<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;
use function Livewire\Volt\{state, rules, updated, mount};
use App\Notifications\ContactNotification;

name('contact-us');

state([
    'name' => null,
    'email' => null,
    'phone' => null,
    'message' => null,
]);


$submit = function () {
    $this->validate([
        'name' => 'required|max:255', // 'required|max:255
        'email' => 'required|email', // 'required|email
        'phone' => 'required|max:255', // 'required
        'message' => 'required|max:2000', // 'required|max:2000
    ]);
    //notify on email
    Notification::route('mail','mehedihasansagor.cse@gmail.com')
        ->notify(new ContactNotification(
            $this->name,
            $this->email,
            $this->phone,
            $this->message
        ));
    //notify on slack

    $this->dispatch('toast', message: 'Successfully submitted.', data: ['position' => 'top-right', 'type' => 'success']);
    $this->reset();
};


?>

<x-layouts.frontend>

    <x-slot name="seo">
        <title> Contact Us | Qrcode Solution</title>
        <meta name="description" content="Free QR Code Generator and online QR code creator. No sign-up required. Create unlimited non-expiring free QR codes for a website URL, YouTube video, Google Maps location, FaceBook link, contact details or any one of 22 QR code types.">
        <meta name="keywords" content="QR code, QR code generator, QR code creator, free QR code, QR code maker, QR code reader, QR code tracking, QR code analytics, QR code campaign, QR code marketing, QR code coupon, QR code vCard, QR code contact, QR code design">

        <meta name="author" content="Qrcode Solution">
        <meta name="robots" content="index,follow">
        <meta name="googlebot" content="index,follow">
        <meta name="google" content="notranslate">
        <meta name="generator" content="Qrcode Solution">
        <meta name="rating" content="general">
        <meta name="distribution" content="global">
        <meta name="subject" content="QR Code Solution">
        <meta name="url" content="https://qrcodesolution.com">
        <meta name="identifier-URL" content="https://qrcodesolution.com">
        <meta name="coverage" content="Worldwide">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- Google / Search Engine Tags --}}
        <meta itemprop="name" content="Contact Us | Qrcode Solution">
        <meta itemprop="description"
            content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta itemprop="image" content="https://qrcodesolution.com/images/logo.png">


        {{-- Facebook Meta Tags --}}
        <meta property="og:url" content="https://qrcodesolution.com">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Contact Us | Qrcode Solution">
        <meta property="og:description"
            content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta property="og:image" content="https://qrcodesolution.com/images/logo.png">

        {{-- Twitter Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Contact Us | Qrcode Solution">
        <meta name="twitter:description"
            content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta name="twitter:image" content="https://qrcodesolution.com/images/logo.png">
        <meta name="twitter:site" content="@qrcodesolution">
        <meta name="twitter:creator" content="@qrcodesolution">






    </x-slot>

    <x-ui.frontend.breadcrumbs :crumbs="[['text' => 'Contact Us']]" />


    <div class="flex items-center justify-center w-full pt-24">
        @volt('contact-us')
        <div class="w-full max-w-xl lg:shrink-0 xl:max-w-2xl">
            <div class="container mx-auto p-8">
                <h1
                    class="text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-6xl grid justify-center mt-5">
                    Contact Us</h1>
            </div>
            <x-card>
                <div class="mt-8">
                    <form wire:submit.prevent="submit">
                        <x-input wire:model="name" type="text" placeholder="Name" class="mt-4"/>
                        <x-input wire:model="email" type="email" placeholder="Email" class="mt-4"/>
                        <x-input wire:model="phone" type="text" placeholder="Phone" class="mt-4"/>
                        <x-textarea wire:model="message" type="text" placeholder="Message" class="mt-4"/>
                        <x-button wire:click="submit" primary class="mt-4">Submit</x-button>
                    </form>
                </div>
            </x-card>
        </div>
        @endvolt

    </div>




</x-layouts.frontend>
