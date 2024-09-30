<a href="{{ $post->url }}" class="flex items-center gap-4 py-4 bg-gray-50 hover:bg-gray-100 border-l-4 rounded-r-2xl border-transparent hover:border-gray-600 transition-all">
    <div></div>
    <div class="flex items-center justify-center w-10 h-10 shrink-0 rounded-md bg-white">
        <span class="font-bold text-lg">
            {{ $index }}
        </span>
    </div>
    <h3 class="font-medium text-gray-500 pr-4">
        {{ $post->name }}
    </h3>
</a>