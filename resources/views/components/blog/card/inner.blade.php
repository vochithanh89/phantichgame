@props([
    'post',
    'size' => 'base',
    'height' => ''
])

@php
    $padding = [
        'sm' => 'p-4 sm:p-4',
        'base' => 'p-4 sm:p-8',
        'md' => 'p-4 sm:p-8',
    ][$size];

    $_size = [
        'sm' => 'md:text-lg lg:text-xl',
        'base' => 'sm:text-lg md:text-xl lg:text-2xl',
        'md' => 'sm:text-xl lg:text-3xl',
    ][$size];

@endphp

<div class="relative w-full h-full group">
    <div class="h-[100%]">
        <figure class="h-{{ $height ?: 'full' }} overflow-hidden rounded-md">
            <img 
                alt="{{ $post->slug }}" 
                loading="lazy"
                class="w-full h-full object-cover object-top group-hover:scale-105 transition-all"
                src="{{ $post->thumbnail_url }}"
            >
        </figure>
    </div>
    <div class="gap-0 absolute bottom-0 rounded-md w-full z-20 {{ $padding }}">
        <div class="flex flex-wrap items-center gap-1.5">
            <a href="{{ $post->category->url }}">
                <div class="text-xs px-4 py-0.5 bg-primary text-white border-0 rounded-md">
                    {{ $post->category->name }}
                </div>
            </a>
        </div>
        <div class="mt-4">
            <a href="{{ $post->url }}">
                <h3 class="{{ $_size }} line-clam-3 font-semibold text-white hover:text-primary-400 transition hover:duration-300 line-clamp-3">
                    {{ $post->name }}
                </h3>
            </a>
        </div>
        @if ($size !== 'sm')
            <div class="mt-5 flex items-center gap-2">
                <div class=" flex items-center gap-2">
                    <img
                        class="w-8 h-8 rounded-full"
                        alt="{{ $post->author->name }}" 
                        loading="lazy" 
                        src="{{ $post->author->profile_photo_url }}"
                    />
                    <span class="text-sm text-white hover:text-primary-400 font-medium transition hover:duration-300">
                        {{ $post->author->name }}
                    </span>
                </div>
                <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                <p class="text-sm text-white">
                    {{ $post->created_at_string }}
                </p>
            </div>
        @endif
    </div>
    <a href="{{ $post->url }}" class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent rounded-xl">
        <span class="hidden">
            {{ $post->name }}
        </span>
    </a>
</div>