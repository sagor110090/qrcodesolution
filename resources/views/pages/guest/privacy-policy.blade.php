<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('privacy-policy');

?>

<x-layouts.frontend>

    <x-slot name="seo">
        <title> Privacy Policy | Qrcode Solution</title>
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
        <meta itemprop="name" content="Privacy Policy | Qrcode Solution">
        <meta itemprop="description"
            content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta itemprop="image" content="https://qrcodesolution.com/images/logo.png">


        {{-- Facebook Meta Tags --}}
        <meta property="og:url" content="https://qrcodesolution.com">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Privacy Policy | Qrcode Solution">
        <meta property="og:description"
            content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta property="og:image" content="https://qrcodesolution.com/images/logo.png">

        {{-- Twitter Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Privacy Policy | Qrcode Solution">
        <meta name="twitter:description"
            content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta name="twitter:image" content="https://qrcodesolution.com/images/logo.png">
        <meta name="twitter:site" content="@qrcodesolution">
        <meta name="twitter:creator" content="@qrcodesolution">






    </x-slot>

    <x-ui.frontend.breadcrumbs :crumbs="[['text' => 'Privacy Policy']]" />


    <div class="flex items-center justify-center w-full pt-24">
        <div class="w-full max-w-xl lg:shrink-0 xl:max-w-2xl">
            <div class="container mx-auto p-8">
                <h1
                    class="text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-6xl grid justify-center mt-5">
                    Privacy Policy</h1>

                <h2 class="text-xl font-semibold mt-8 dark:text-white">Introduction</h2>
                <p class="dark:text-white">Welcome to qrcodesolution.com ("we," "us," or "our"). We are committed to
                    protecting the privacy and
                    security of your personal information. This Privacy Policy explains how we collect, use, disclose,
                    and safeguard your personal data when you use our website.</p>

                <p class="dark:text-white">Please read this Privacy Policy carefully to understand our practices
                    regarding your personal
                    information and how we will handle it. By accessing or using our website, you consent to the
                    practices described in this Privacy Policy.</p>

                <h2 class="text-xl font-semibold mt-8 dark:text-white">Information We Collect</h2>
                <h3 class="text-lg font-semibold mt-4">1. Personal Information</h3>
                <p class="dark:text-white">We may collect personal information that you provide voluntarily when you
                    interact with our website.
                    This information may include but is not limited to:</p>
                <ul class="list-disc pl-8 dark:text-white">
                    <li>Name</li>
                    <li>Email address</li>
                    <li>Contact information</li>
                    <li>User preferences</li>
                </ul>

                <h3 class="text-lg font-semibold mt-4">2. Non-Personal Information</h3>
                <p class="dark:text-white">We may also automatically collect non-personal information when you access
                    our website. This
                    information may include:</p>
                <ul class="list-disc pl-8 dark:text-white">
                    <li>IP address</li>
                    <li>Browser type</li>
                    <li>Operating system</li>
                    <li>Usage data</li>
                </ul>

                <h2 class="text-xl font-semibold mt-8 dark:text-white">How We Use Your Information</h2>
                <p class="dark:text-white">We use your personal information for the following purposes:</p>
                <ul class="list-disc pl-8 dark:text-white">
                    <li>To provide you with the products and services you request.</li>
                    <li>To respond to your inquiries and provide customer support.</li>
                    <li>To send periodic emails and updates related to our services.</li>
                    <li>To personalize your experience on our website.</li>
                    <li>To improve our website and services.</li>
                </ul>

                <h2 class="text-xl font-semibold mt-8 dark:text-white">Disclosure of Your Information</h2>
                <p class="dark:text-white">We may share your personal information with:</p>
                <ul class="list-disc pl-8 dark:text-white">
                    <li>Service providers and business partners to assist in our operations.</li>
                    <li>Government authorities when required by law or to protect our rights or the safety of others.
                    </li>
                </ul>

                <h2 class="text-xl font-semibold mt-8 dark:text-white">Your Choices</h2>
                <p class="dark:text-white">You can choose not to provide us with certain personal information, but this
                    may limit your ability
                    to use certain features of our website. You can opt-out of receiving promotional emails from us by
                    following the instructions in those emails.</p>

                <h2 class="text-xl font-semibold mt-8 dark:text-white">Security</h2>
                <p class="dark:text-white">We take reasonable measures to protect your personal information from
                    unauthorized access,
                    disclosure, alteration, or destruction. However, no data transmission over the internet or
                    electronic storage is entirely secure, so we cannot guarantee absolute security.</p>

                <h2 class="text-xl font-semibold mt-8 dark:text-white">Changes to this Privacy Policy</h2>
                <p class="dark:text-white">We may update this Privacy Policy from time to time to reflect changes in our
                    practices or for other
                    operational, legal, or regulatory reasons. We will provide notice of any material changes through
                    our website or other means. Your continued use of our website after such changes constitutes your
                    acceptance of the revised Privacy Policy.</p>

                <h2 class="text-xl font-semibold mt-8 dark:text-white">Contact Us</h2>
                <p class="dark:text-white">If you have any questions or concerns about this Privacy Policy, please
                    contact us at hello@qrcodesolution.com.</p>
            </div>
        </div>

    </div>




</x-layouts.frontend>
