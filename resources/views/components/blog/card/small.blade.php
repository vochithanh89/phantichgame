<div class="flex overflow-hidden pb-4">
    <a href="{{ $post->url }}" class="group relative block shrink-0 self-start overflow-hidden rounded-md bg-gray-100 w-auto aspect-square lg:aspect-[16/10] h-36">
        <img src="{{ $post->thumbnail_url }}" loading="lazy" alt="{{ $post->slug }}" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110">
    </a>

    <div class="flex flex-col justify-between px-6">
        <div class="w-full flex flex-col gap-2">
            <div class="flex items-center gap-2">
                <a class="hidden lg:block text-primary hover:text-primary-700 text-xs uppercase tracking-widest font-bold" href="{{ $post->category->url }}">
                    {{ $post->category->name }}
                </a>
                <span class="hidden lg:block w-1 h-1 bg-gray-400 rounded-full"></span>
                <span class="text-gray-500 text-xs tracking-wider font-medium">
                    {{ $post->read_time }} đọc
                </span>
            </div>
        
            <h3 class="font-bold text-gray-800">
                <a href="{{ $post->url }}" class="line-clamp-2 transition duration-100 hover:text-primary-500 active:text-primary-600">
                    {{ $post->name }}
                </a>
            </h3>
        
            <p class="text-sm text-gray-500 line-clamp-2">
                {{ $post->description }}    
            </p>
        </div>

        {{-- author --}}
        <div class="mt-2 flex items-center gap-2">
            <img src="{{ $post->author->profile_photo_url }}" loading="lazy" alt="{{ $post->slug }}" class="w-8 h-8 rounded-full border">
            <p class="text-sm font-semibold">
                {{ $post->author->name }}   
            </p>
        </div>
    </div>
</div>