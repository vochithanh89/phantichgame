<div class="flex flex-col overflow-hidden pb-4">
    <a href="{{ $post->url }}" class="mb-4 group relative block shrink-0 self-start overflow-hidden rounded-md bg-gray-100 w-full lg:h-40 aspect-[16/10]">
        <img src="{{ $post->thumbnail_url }}" loading="lazy" alt="{{ $post->slug }}" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110">
    </a>
    
    <div class="w-full flex flex-col gap-2">
        <div class="flex items-center gap-2">
            {{-- <a class="text-primary hover:text-primary-700 text-xs uppercase tracking-widest font-bold" href="{{ $post->category->url }}">
                {{ $post->category->name }}
            </a>
            <span class="w-1 h-1 bg-gray-400 rounded-full"></span> --}}
            <span class="text-gray-500 text-sm tracking-wider font-medium">
                {{ $post->read_time }} đọc
            </span>
        </div>
    
        <h3 class="mb-2 font-bold text-lg text-gray-800">
            <a href="{{ $post->url }}" class="line-clamp-2 transition duration-100 hover:text-primary-500 active:text-primary-600">
                {{ $post->name }}
            </a>
        </h3>
    
        {{-- author --}}
        <div class="flex items-center gap-2">
            <div class="flex items-center gap-2">
                <img src="{{ $post->author->profile_photo_url }}" loading="lazy" alt="{{ $post->slug }}" class="w-6 h-6 rounded-full border">
                <p class="text-sm font-semibold">
                    {{ $post->author->name }}   
                </p>
            </div>
            <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
            <span class="text-gray-500 text-xs tracking-wider font-medium">
                {{ $post->created_at_string }}
            </span>
        </div>
    </div>
</div>