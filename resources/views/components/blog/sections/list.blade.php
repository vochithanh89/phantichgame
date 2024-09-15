@props(['posts' => []])

<div class="col-span-12 lg:col-span-8">
    <div class="mb-6">
        <x-shared.title title="Bài viết mới nhất" />
    </div>
    <div class="w-full">
        <div class="grid grid-cols-1 gap-5">
            @foreach ($posts as $post)
                <x-blog.card.default :post="$post" />
            @endforeach
        </div>
    </div>
    <div class="flex justify-center mt-8">
        <a
            class="border hover:badge text-content px-4 py-2 rounded-sm font-medium text-sm transition-all"
            href="{{ route('blog.index') }}"
            >Xem tất cả</a
        >
    </div>
</div>
