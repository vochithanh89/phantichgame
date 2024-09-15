@props(['posts' => []])

<section>
    <div class="mb-6">
        <x-shared.title title="Bài viết được yêu thích" />
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="relative font-semibold h-full">
            @if (!empty($posts[0]))
                <x-blog.card.inner :post="$posts[0]" />
                @php
                    $posts->shift();
                @endphp
            @endif
        </div>
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 items-center gap-5">
            @foreach ($posts as $post)
                <x-blog.card.tiny :post="$post" />
            @endforeach
        </div>
    </div>
</section>
