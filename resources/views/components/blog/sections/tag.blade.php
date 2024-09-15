@php
    use App\Models\Tag;
    use App\Models\BlogPost;

    $tagIds = \DB::table('taggables')
        ->distinct()
        ->select('tag_id')
        ->where('taggable_type', BlogPost::class)
        ->get()
        ->pluck('tag_id');

    $tags = Tag::whereIn('id', $tagIds)->take(20)->get();

@endphp

<section>
    <div
        class="flex flex-wrap md:flex-nowrap items-center justify-center gap-4 p-5 border border-base-content border-opacity-10 rounded-xl">
        <p class="uppercase font-semibold text-base whitespace-nowrap leading-5">
            Chủ đề nóng:
        </p>
        <div class="flex flex-wrap justify-center md:justify-start items-center gap-1">
            @foreach ($tags as $tag)
                <a href="{{ $tag->url }}"
                    class="px-4 py-1 rounded-md text-sm bg-primary-600 bg-opacity-5 text-primary-600 font-medium">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>
