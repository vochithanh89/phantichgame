<div class="grid gap-4">
    @foreach ($posts as $post)
        <x-blog.card.default :post="$post" />
    @endforeach
</div>