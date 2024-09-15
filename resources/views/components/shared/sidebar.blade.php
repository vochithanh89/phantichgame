@php
    use App\Models\Tag;
    use App\Models\BlogPost;
    use App\Models\BlogCategory;

    $tagIds = \DB::table('taggables')
        ->distinct()
        ->select('tag_id')
        ->where('taggable_type', BlogPost::class)
        ->get()
        ->pluck('tag_id');

    $categories = BlogCategory::where(['is_published' => 1])
        ->where('parent_id', '<>', null)
        ->take(20)
        ->get();

    $posts = BlogPost::getPopularPosts(10);

@endphp


<div class="w-full">

    <div class="mb-8">
        <x-shared.search-form />
    </div>

    <div class="mb-8">
        <div class="lg:p-8 lg:border rounded-xl w-full">
            <h2 class="text-base-content font-bold text-xl font-work">Bài viết phổ biến</h2>
            <div class="grid grid-cols-1 gap-6 mt-8">
                <div class="grid gap-6">
                    @foreach ($posts as $post)
                        <div>
                            <div class="p-0">
                                <div class="flex items-center gap-4 font-work">
                                    <figure class="flex-none">
                                        <a href="{{ $post->url }}">
                                            <img class="rounded-md w-28 h-16 object-cover" loading="lazy"
                                                alt="{{ $post->slug }}" src="{{ $post->thumbnail_url }}">
                                        </a>
                                    </figure>
                                    <div>
                                        <h2>
                                            <a href="{{ $post->url }}"
                                                class="font-work line-clamp-2 font-semibold text-base text-base-content leading-5 hover:text-primary-600 transition hover:duration-300">
                                                {{ $post->name }}
                                            </a>
                                        </h2>
                                        <p class="mt-2.5 text-gray-500 text-sm">
                                            {{ $post->created_at_string }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <div class="rounded-xl border p-8">
            <h2 class="text-base-content font-bold text-xl font-work">Chủ đề</h2>
            <div class="pt-6">
                @foreach ($categories as $category)
                    <div
                        class="flex items-center justify-between last:border-none border-b py-3.5">
                        <a href="{{ $category->url }} "
                            class="text-base font-medium text-base-content text-opacity-70 capitalize hover:text-primary-600 transition ease-in-out duration-300">
                            {{ $category->name }}
                        </a>
                        <span
                            class="px-2 py-1 rounded-md bg-primary-600 bg-opacity-5 text-primary-600 text-xs font-medium">
                            {{ $category->posts->count() }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
