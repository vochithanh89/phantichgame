@props(['posts' => []])

@php
    $_posts = clone $posts;
    $_posts = $_posts->splice(0, 3);
@endphp

<section>
    <div class="flex flex-col md:flex-row gap-5">
        <div class="w-full md:w-6/12">
            @if (!empty($_posts[0]))
                <x-blog.card.inner size="base" :post="$_posts[0]" />
                @php
                    $_posts->shift();
                @endphp
            @endif
        </div>
        <div class="w-full md:w-6/12 flex flex-col gap-5">
            @foreach ($_posts as $post)
                <x-blog.card.inner size="base" height="72" :post="$post" />
            @endforeach
        </div>
    </div>
    <span class="h-72 hidden"></span>
</section>
