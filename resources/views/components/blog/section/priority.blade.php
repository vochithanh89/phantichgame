<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach ($posts as $post)
        <x-blog.card.vertical :post="$post" />
    @endforeach
</div>