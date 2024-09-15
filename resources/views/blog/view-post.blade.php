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

    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="mb-4">
                    {!! Breadcrumbs::render('post') !!}
                </div>
                {{-- category --}}
                <div class="w-fit text-white px-2.5 py-1 bg-primary-600 text-xs md:text-sm rounded-md mb-2 md:mb-4">
                    <a href="{{ $post->category->url }}">
                        {{ $post->category->name }}
                    </a>
                </div>

                {{-- title --}}
                <h1 class="mb-6 text-base-content font-semibold text-3xl leading-10 ">
                    {{ $title }}
                </h1>

                {{-- author --}}
                <div class="mb-6 flex gap-2 items-center">
                    <img class="h-8 w-8 rounded-full" src="{{ $post->author->profile_photo_url }}" alt="">
                    <div>
                        {{-- <span class="text-sm text-gray-400">by</span> --}}
                        <span class="text-sm font-medium text-default">
                            {{ $post->author->name }}
                        </span>
                    </div>
                    <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                    <span class="text-sm text-gray-400">
                        {{ $post->created_at_string }}
                    </span>
                </div>
                {{-- desc --}}
                <p class="mb-8 text-lg font-semibold text-default">
                    {{ $post->description }}
                </p>
                {{-- thumbnail --}}
                <div class="mb-6">
                    <img class="w-full" src="{{ $post->thumbnail_url }}" alt="{{ $post->alias }}">
                </div>
                {{-- content --}}
                <x-shared.article-content :content="$post->content" />

                {{-- tags --}}
                <div class="mt-8 flex flex-wrap gap-4 justify-between">
                    <div>
                        <p class="inline-block mr-4 font-semibold text-default">Tags:</p>
                        <div class="inline-flex flex-wrap items-center gap-2">
                            @foreach ($post->tags as $tag)
                                <a href="{{ $tag->url }}" class="rounded-md text-sm text-primary-600 font-medium">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="mr-4 font-semibold text-default">Chia sẻ: </p>
                        <div class="inline-flex items-center gap-2">
                            <div x-data="{
                                shareUrl: '{{ 'https://www.facebook.com/sharer/sharer.php?u=' . url()->current() }}',
                                handleShare: () => {
                                    window.open($data.shareUrl, 'Facebook', 'height=600,width=600,top=50%,left=50%');
                                }
                            }">
                                <a href="javascript:;" @click="handleShare">
                                    <x-carbon-logo-facebook class="w-8 rounded-full text-sky-600" />
                                </a>
                            </div>

                            <div x-data="{
                                shareUrl: '{{ 'https://twitter.com/intent/post?text=' . $post->name . '&url=' . urlencode(url()->current()) }}',
                                handleShare: () => {
                                    window.open($data.shareUrl, 'Facebook', 'height=600,width=600,top=50%,left=50%');
                                }
                            }">
                                <a href="javascript:;" @click="handleShare">
                                    <x-carbon-logo-twitter class="w-8 rounded-full text-sky-600" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                {{-- related post --}}
                <div class="mb-6">
                    <x-shared.title title="Bài viết liên quan" />
                </div>
                <div class="grid grid-cols-1 gap-5">
                    @foreach ($post->related_posts as $post)
                        <x-blog.card.default :post="$post" />
                    @endforeach
                </div>
                <div class="flex justify-center mt-8">
                    <a
                        class="border hover:badge text-content px-4 py-2 rounded-sm font-medium text-sm transition-all"
                        href="{{ route('blog.index') }}"
                        >Xem tất cả</a
                    >
                </div>
            </div>
            <div>
                <x-shared.sidebar />
            </div>
        </div>
    </div>

</x-app-layout>
