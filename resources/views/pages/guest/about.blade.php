<?php

use function Laravel\Folio\{name};

name('about');

?>

<x-layouts.frontend>

    <x-slot name="seo">
        <title> About Us | Qrcode Solution</title>
        <meta name="description" content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
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

        {{-- HTML Meta Tags --}}
        <title>About Us | Qrcode Solution</title>
        <meta name="description" content="Free QR Code Generator and online QR code creator. No sign-up required. Create unlimited non-expiring free QR codes for a website URL, YouTube video, Google Maps location, FaceBook link, contact details or any one of 22 QR code types.">
        <meta name="keywords" content="QR code, QR code generator, QR code creator, free QR code, QR code maker, QR code reader, QR code tracking, QR code analytics, QR code campaign, QR code marketing, QR code coupon, QR code vCard, QR code contact, QR code design">

        {{-- Google / Search Engine Tags --}}
        <meta itemprop="name" content="About Us | Qrcode Solution">
        <meta itemprop="description" content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta itemprop="image" content="https://qrcodesolution.com/images/logo.png">


        {{-- Facebook Meta Tags --}}
        <meta property="og:url" content="https://qrcodesolution.com">
        <meta property="og:type" content="website">
        <meta property="og:title" content="About Us | Qrcode Solution">
        <meta property="og:description" content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta property="og:image" content="https://qrcodesolution.com/images/logo.png">

        {{-- Twitter Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="About Us | Qrcode Solution">
        <meta name="twitter:description" content="Our QR Code solution is an all-in-one platform that includes a QR Code generator, a mobile landing page builder, and a tracking tool.">
        <meta name="twitter:image" content="https://qrcodesolution.com/images/logo.png">
        <meta name="twitter:site" content="@qrcodesolution">
        <meta name="twitter:creator" content="@qrcodesolution">



    </x-slot>

    <div class="w-full">

        <x-ui.frontend.breadcrumbs :crumbs="[['text' => 'About']]" />

        <div class="flex items-center justify-center w-full pt-24">
            <div class="w-full max-w-xl lg:shrink-0 xl:max-w-2xl">
                <h1
                    class="text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-6xl grid justify-center mt-5">
                    About Us
                </h1>
                <div class="container mx-auto p-4">
                    <section class="mt-8">
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Our Mission</h2>
                        <p class="mt-4 text-slate-900 dark:text-slate-100">Our mission is to empower individuals and
                            businesses by harnessing the power of QR codes. We are committed to delivering
                            user-friendly, innovative, and value-driven QR code solutions that help you connect with
                            your audience, simplify processes, and stay ahead in this rapidly evolving digital
                            landscape.</p>
                    </section>

                    <section class="mt-8">
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Why Choose Us?</h2>
                        <div class="mt-4 space-y-4">
                            <p class="text-slate-900 dark:text-slate-100">
                                <span class="text-blue-500 font-semibold">1. Simplicity and Accessibility:</span> We
                                make QR codes accessible to all. Our user-friendly platform ensures that you can
                                generate and customize QR codes with ease, even if you have no technical background.
                            </p>
                            <p class="text-slate-900 dark:text-slate-100">
                                <span class="text-blue-500 font-semibold">2. Versatility:</span> We offer a wide range
                                of QR code types, from simple website links to complex data encoding. Whether you need
                                QR codes for marketing campaigns, contactless payments, or inventory management, we have
                                you covered.
                            </p>
                            <p class="text-slate-900 dark:text-slate-100">
                                <span class="text-blue-500 font-semibold">3. Reliability:</span> We take quality
                                seriously. Our QR codes are designed to be robust, ensuring that they scan accurately
                                and consistently across various devices and environments.
                            </p>
                            <p class="text-slate-900 dark:text-slate-100">
                                <span class="text-blue-500 font-semibold">4. Innovation:</span> QR codes are constantly
                                evolving, and so are we. We stay at the forefront of QR code technology to provide you
                                with cutting-edge solutions that meet your ever-changing needs.
                            </p>
                            <p class="text-slate-900 dark:text-slate-100">
                                <span class="text-blue-500 font-semibold">5. Customer-Centric Approach:</span> Your
                                success is our success. We are here to support you every step of the way, offering
                                responsive customer service and resources to assist you in making the most of QR codes.
                            </p>
                        </div>
                    </section>

                    <section class="mt-8">
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Join Our QR Code
                            Revolution</h2>
                        <p class="mt-4 text-slate-900 dark:text-slate-100">At QRCodeSolution.com, we are not just about
                            QR codes; we are about simplifying your life and your business. Whether you're looking to
                            enhance your marketing strategy, streamline operations, or create interactive customer
                            experiences, we have the solutions you need.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-layouts.frontend>
