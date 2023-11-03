<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;


name('privacy-policy');


?>

<x-layouts.frontend>

    <x-ui.frontend.breadcrumbs :crumbs="[ ['text' => 'Privacy Policy'] ]" />


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
