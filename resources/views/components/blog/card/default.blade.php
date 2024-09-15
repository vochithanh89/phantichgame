<div class="flex flex-col items-center overflow-hidden pb-4 border-b sm:flex-row">
    <a href="{{ $post->url }}" class="group relative block shrink-0 self-start overflow-hidden rounded-md bg-gray-100 w-full sm:w-auto aspect-video sm:h-48">
        <img src="{{ $post->thumbnail_url }}" loading="lazy" alt="{{ $post->slug }}" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110">
    </a>

    <div class="w-full flex flex-col gap-2 py-6 sm:px-6 sm:py-0">
        <a class="text-primary text-xs uppercase tracking-widest font-semibold rounded-md" href="{{ $post->category->url }}">
            {{ $post->category->name }}
        </a>

        <h3 class="text-xl font-bold text-gray-800">
            <a href="{{ $post->url }}" class="transition duration-100 hover:text-primary-500 active:text-primary-600">
                {{ $post->name }}
            </a>
        </h3>

        <p class="mb-4 text-gray-500 line-clamp-2">
            {{ $post->description }}    
        </p>

        <div class="flex gap-2 items-center">
            <img class="h-8 w-8 rounded-full" src="{{ $post->author->profile_photo_url }}" alt="">
            <div>
                {{-- <span class="text-sm text-gray-400">by</span> --}}
                <span class="text-sm text-default">
                    {{ $post->author->name }}
                </span>
            </div>
            <span class="w-1 h-1 rounded-full bg-gray-400"></span>
            <span class="text-sm text-gray-400">
                {{ $post->created_at_string }}
            </span>
        </div>
    </div>
</div>