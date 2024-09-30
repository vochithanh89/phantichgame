<div class="grid lg:grid-cols-2 gap-4">
    @foreach ($posts as $post)
        <x-blog.card.small :post="$post" />
    @endforeach
</div>