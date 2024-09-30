@php
    use App\Models\Tag;
    use App\Models\BlogPost;
    use App\Models\BlogCategory;

    $categories = BlogCategory::where(['is_published' => 1])
        ->where(['parent_id' => null])
        ->take(20)
        ->get();

    $posts = BlogPost::getPopularPosts(10);

@endphp


<div class="w-full space-y-8">

    <div>
        <div class="">
            <x-shared.title title="Có thể bạn sẽ thích" />
            <div class="grid grid-cols-1 gap-6 mt-8">
                <div class="grid gap-2">
                    @foreach ($posts as $index => $post)
                        <x-blog.card.tiny :index="$index + 1" :post="$post" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div>
        <x-shared.title title="Chủ đề" />
        <div class="flex flex-wrap gap-2">
            @foreach ($categories as $category)
                <a href="{{ $category->url }} "
                    class="border rounded-full px-4 py-2 text-sm font-medium capitalize hover:text-primary-600 hover:border-primary-600 transition ease-in-out duration-300">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div>
        <x-shared.title title="Theo dõi Phân Tích Game" />
        <div class="flex flex-wrap gap-4">
            <a target="_blank" href="javascript:;" rel="dofollow" title="Phân Tích Game" class="text-gray-400 hover:text-primary transition-all">
                <svg class="size-7 fill-current"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64h98.2V334.2H109.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H255V480H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg>
            </a>
            <a href="javascript:;" class="text-gray-400 hover:text-red-600 transition-all">
                <svg class="size-7 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>            
            </a>
            <a href="javascript:;" class="text-gray-400 hover:text-gray-900 transition-all">
                <svg class="size-7 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/></svg>            
            </a>
        </div>
    </div>

    
</div>
