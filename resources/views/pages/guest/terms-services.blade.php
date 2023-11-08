<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('terms');

?>

<x-layouts.frontend>

    <x-slot name="seo">
        <title> Terms of Service | Qrcode Solution</title>
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
        <meta itemprop="name" content="Terms of Service | Qrcode Solution">
        <meta itemprop="description"
            content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta itemprop="image" content="https://qrcodesolution.com/images/logo.png">


        {{-- Facebook Meta Tags --}}
        <meta property="og:url" content="https://qrcodesolution.com">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Terms of Service | Qrcode Solution">
        <meta property="og:description"
            content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta property="og:image" content="https://qrcodesolution.com/images/logo.png">

        {{-- Twitter Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Terms of Service | Qrcode Solution">
        <meta name="twitter:description" content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta name="twitter:image" content="https://qrcodesolution.com/images/logo.png">
        <meta name="twitter:site" content="@qrcodesolution">
        <meta name="twitter:creator" content="@qrcodesolution">

    </x-slot>

    <x-ui.frontend.breadcrumbs :crumbs="[['text' => 'Terms of Service']]" />


    <div class="flex items-center justify-center w-full pt-24">
        <div class="w-full max-w-xl lg:shrink-0 xl:max-w-2xl">
            <div class="container mx-auto p-8">
                <h1
                    class="text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-6xl grid justify-center mt-5">
                    Terms of Service
                </h1>
                <p class="dark:text-white mt-8">These Terms and Conditions (&quot;Terms&quot;) govern your use of the
                    qrcodesolution.com website
                    (&quot;Website&quot;). By accessing or using the Website, you agree to comply with and be bound by
                    these
                    Terms. If you do not agree with these Terms, please do not use the Website.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">1. Acceptance
                        of
                        Terms</strong></p>
                <p class="dark:text-white mt-8">By using the Website, you agree to be bound by these Terms, including
                    any
                    future modifications.
                    Qrcodesolution.com reserves the right to update or change these Terms at any time. Please review the
                    Terms regularly to stay informed of any changes.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">2. Use of the
                        Website</strong></p>
                <p class="dark:text-white mt-8">You agree to use the Website in accordance with all applicable local,
                    state,
                    national, and international
                    laws and regulations. You will not use the Website for any unlawful or prohibited purpose.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">3.
                        Intellectual
                        Property</strong></p>
                <p class="dark:text-white mt-8">All content on the Website, including but not limited to text, graphics,
                    logos, images, software, and
                    source code, is the property of qrcodesolution.com and is protected by copyright, trademark, and
                    other
                    intellectual property laws. You may not use, modify, or distribute the content without our prior
                    written
                    consent.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">4.
                        User-Generated
                        Content</strong></p>
                <p class="dark:text-white mt-8">If the Website allows users to submit content, you agree not to post,
                    upload,
                    or transmit any content
                    that is illegal, offensive, or violates the rights of others. Qrcodesolution.com may, at its
                    discretion,
                    remove or moderate user-generated content.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">5. Privacy
                        Policy</strong></p>
                <p class="dark:text-white mt-8">Your use of the Website is also governed by our Privacy Policy, which is
                    incorporated by reference into
                    these Terms. Please review our Privacy Policy to understand how we collect, use, and protect your
                    personal information.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">6. Links to
                        Third-Party Websites</strong></p>
                <p class="dark:text-white mt-8">The Website may contain links to third-party websites or services that
                    are
                    not owned or controlled by
                    qrcodesolution.com. We are not responsible for the content or practices of these third-party
                    websites,
                    and your use of such websites is at your own risk.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">7.
                        Disclaimers</strong></p>
                <p class="dark:text-white mt-8">The Website is provided on an &quot;as is&quot; and &quot;as
                    available&quot;
                    basis. Qrcodesolution.com
                    makes no warranties or representations regarding the accuracy, reliability, or availability of the
                    Website.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">8. Limitation
                        of
                        Liability</strong></p>
                <p class="dark:text-white mt-8">In no event shall qrcodesolution.com be liable for any direct, indirect,
                    special, consequential, or
                    incidental damages arising out of or in connection with the use of the Website.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">9.
                        Indemnification</strong></p>
                <p class="dark:text-white mt-8">You agree to indemnify and hold qrcodesolution.com, its affiliates, and
                    its
                    officers, directors, and
                    employees, harmless from any claim or demand, including reasonable attorney&#39;s fees, made by any
                    third party due to or arising out of your use of the Website.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">10.
                        Termination</strong></p>
                <p class="dark:text-white mt-8">Qrcodesolution.com reserves the right to terminate or suspend your
                    access to
                    the Website at any time,
                    with or without cause and with or without notice.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">11. Governing
                        Law</strong></p>
                <p class="dark:text-white mt-8">These Terms are governed by and construed in accordance with the laws of
                    [Your Jurisdiction], without
                    regard to its conflict of law principles.</p>
                <p class="dark:text-white mt-8"><strong class="text-xl font-semibold mt-8 dark:text-white">12. Contact
                        Information</strong></p>
                <p class="dark:text-white mt-8">If you have any questions about these Terms, please contact us at
                    hello@qrcodesolution.com.</p>


            </div>

        </div>
    </div>





</x-layouts.frontend>
