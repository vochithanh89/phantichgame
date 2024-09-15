@props(['posts' => []])

<section>
    <div class="mb-6">
        <x-shared.title title="Phổ biến" />
    </div>
    <div class="w-full grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        @foreach ($posts as $post)
            <x-blog.card.inner size="sm" height="96" :post="$post" />
        @endforeach
    </div>
    <span class="hidden h-96"></span>
</section>
