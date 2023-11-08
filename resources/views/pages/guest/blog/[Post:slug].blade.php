<x-layouts.frontend>

    <x-slot name="seo">
        <title> {{ $post->meta_title ?? $post->title }} | Qrcode Solution</title>
        <meta name="description" content="{{ $post->meta_description ?? Str::limit($post->content, 160) }}">
        <meta name="author" content="Qrcode Solution">
        <meta name="robots" content="index,follow">
        <meta name="googlebot" content="index,follow">
        <meta name="google" content="notranslate">
        <meta name="generator" content="Qrcode Solution">
        <meta name="rating" content="general">
        <meta name="distribution" content="global">
        <meta name="subject" content="QR Code Solution">
        <meta name="url" content="https://qrcodesolution.com/blog/{{ $post->slug }}">
        <meta name="identifier-URL" content="https://qrcodesolution.com/blog/{{ $post->slug }}">
        <meta name="coverage" content="Worldwide">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- HTML Meta Tags --}}
        <title>{{ $post->meta_title ?? $post->title }} | Qrcode Solution</title>
        <meta name="description" content="{{ $post->meta_description ?? Str::limit($post->content, 160) }}">
        <meta name="keywords" content="{{ $post->meta_keywords ?? '' }}">

        {{-- Google / Search Engine Tags --}}
        <meta itemprop="name" content="{{ $post->meta_title ?? $post->title }}">
        <meta itemprop="description" content="{{ $post->meta_description ?? Str::limit($post->content, 160) }}">
        <meta itemprop="image" content="{{ $post->image ?? '' }}">

        {{-- Facebook Meta Tags --}}
        <meta property="og:url" content="https://qrcodesolution.com/blog/{{ $post->slug }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $post->meta_title ?? $post->title }}">
        <meta property="og:description" content="{{ $post->meta_description ?? Str::limit($post->content, 160) }}">
        <meta property="og:image" content="{{ $post->image ?? '' }}">

        {{-- Twitter Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $post->meta_title ?? $post->title }}">
        <meta name="twitter:description" content="{{ $post->meta_description ?? Str::limit($post->content, 160) }}">
        <meta name="twitter:image" content="{{ $post->image ?? '' }}">
        <meta name="twitter:site" content="@qrcodesolution">
        <meta name="twitter:creator" content="@qrcodesolution">

    </x-slot>

    <x-ui.frontend.breadcrumbs :crumbs="[
        [
            'href' => '/blog',
            'text' => 'Blog'
        ],
        [
            'text' => $post->title
        ]
    ]" />

    <article class="relative w-full h-auto mx-auto prose-sm prose md:prose-2xl dark:prose-invert">
        <div class="py-6 mx-auto heading md:py-12 lg:w-full md:text-center">

            <div class="flex flex-col items-center justify-center mt-4 mb-0">
                <h1 class="!mb-0 font-sans text-4xl font-bold heading md:text-6xl dark:text-white md:leading-tight">
                    {{ $post->title }}
                </h1>
            </div>

            <div class="flex items-center justify-center">
                <div class="ml-2">
                    <p class="text-sm text-gray-600 dark:text-gray-500">Posted on {{ $post->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            @if ($post->image)
                <img src="@if(str_starts_with($post->image, 'https') || str_starts_with($post->image, 'http')){{ $post->image }}@else{{ asset('storage/' . $post->image) }}@endif" alt="{{ $post->title }}" class="w-full mx-auto mt-4">
            @endif

            <div class="flex items-center justify-center mt-4 text-left">
                <div class="max-w-full -mt-5 text-lg text-gray-600 whitespace-pre-line dark:text-gray-300">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </article>
</x-layouts.frontend>
