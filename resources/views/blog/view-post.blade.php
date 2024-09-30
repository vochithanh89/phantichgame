@php
    use Rawilk\Breadcrumbs\Facades\Breadcrumbs;
    use Rawilk\Breadcrumbs\Support\Generator;
    use Spatie\SchemaOrg\Schema;
    
    $title = $post->meta_name;
    $description = $post->meta_desc;
    $image = $post->thumbnail_url;

    // Home
    Breadcrumbs::for('home', fn (Generator $trail) => $trail->push('Trang chủ', '/'));
    Breadcrumbs::for(
        'blog',
        fn (Generator $trail) => $trail->parent('home')->push('Bài viết', route('blog.index')
    ));
    Breadcrumbs::for(
        'category',
        fn (Generator $trail) => $trail->parent('blog')->push($post->category->name, $post->category->url)
    );
    Breadcrumbs::for(
        'post',
        fn (Generator $trail) => $trail->parent('category')->push($title)
    );
        
@endphp

<x-app-layout>
    @section('title', $title)
    @section('description', $description)
    @section('image', $image)
    @section('schema')
        {!! Breadcrumbs::view('breadcrumbs::json-ld', 'post') !!}
        {!!
            Schema::newsArticle()
                ->headline($title)
                ->image([$post->thumbnail_url])
                ->datePublished($post->created_at)
                ->dateModified($post->updated_at)
                ->author([
                    Schema::person()
                        ->name($post->author->name),
                ])
                ->toScript();    
        !!}
    @endsection

    <div class="relative -mt-5 h-80 w-full bg-cover bg-fixed bg-center" style="background-image: url('{{ $post->thumbnail_url }}')">
        <div class="absolute inset-0 w-full h-full bg-black/40"></div>
    </div>

    <div class="relative mx-auto max-w-4xl p-4 bg-white">
        <div class="mt-8 mb-4">
            <a href="{{ $post->category->url }}" class="text-gray-500 hover:underline" >
                {{ $post->category->name }}
            </a>
        </div>
        
        {{-- title --}}
        <h1 class="mb-6 text-base-content font-semibold text-4xl leading-10">
            {{ $post->name }}
        </h1>
        {{-- description --}}
        <p class="mb-4 text-lg font-semibold italic text-default">
            {{ $post->description }}
        </p>

        <div class="mb-8 flex items-center gap-2">
            <div class="flex items-center gap-2">
                <img src="{{ $post->author->profile_photo_url }}" loading="lazy" alt="{{ $post->slug }}" class="w-10 h-10 rounded-full">
                <p class="text-sm font-semibold">
                    {{ $post->author->name }}   
                </p>
            </div>
            <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
            <span class="text-gray-500 text-sm tracking-wider font-medium">
                {{ $post->created_at_string }}
            </span>
        </div>

        <x-shared.article-content :post="$post" />

        {{-- tags --}}
        <div class="mt-6 mb-8 flex flex-wrap lg:flex-nowrap gap-4 items-start justify-between">
            <div class="inline-flex flex-wrap gap-2">
                @foreach ($post->tags as $tag)
                    <a href="{{ $tag->url }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm text-gray-500 font-medium transition-all">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
            <x-shared.social-bar :post="$post" />
        </div>

    </div>

    <div class="container space-y-12">
        <div>
            <x-shared.title title="Bài viết liên quan" />
            <x-blog.section.priority :posts="$post->related_posts" />
        </div>
        <div>
            <x-shared.title title="Có thể bạn sẽ thích" />
            <x-blog.section.priority :posts="$post->recommend_posts" />
        </div>
    </div>

</x-app-layout>
