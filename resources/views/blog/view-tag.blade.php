@php
    use Rawilk\Breadcrumbs\Facades\Breadcrumbs;
    use Rawilk\Breadcrumbs\Support\Generator;

    $title = "Các bài review, phân tích phim ảnh về $tag->name";
    $description = "Cập nhật các bài review, phân tích phim ảnh mới nhất liên quan đến $tag->name";

    // Home
    Breadcrumbs::for('home', fn (Generator $trail) => $trail->push('Trang chủ', '/'));
    Breadcrumbs::for(
        'blog',
        fn (Generator $trail) => $trail->parent('home')->push('Bài viết', route('blog.index'))
    );
    Breadcrumbs::for(
        'tag',
        fn (Generator $trail) => $trail->parent('blog')->push($title)
    );
    
@endphp

<x-app-layout>
    @section('title', $title)
    @section('description', $description)
    @section('schema')
        {!! Breadcrumbs::view('breadcrumbs::json-ld', 'tag') !!}
    @endsection

    <div class="mb-8">
        <x-shared.hero-heading :title="$title" :description="$description" />
    </div>

    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <x-shared.title :title="$title" />
                <x-blog.section.default :posts="$posts" />
                <div class="mt-8">
                    {{ $posts->links('components.shared.pagination') }}
                </div>
            </div>
            <div>
                <x-shared.sidebar />
            </div>
        </div>
    </div>

</x-app-layout>
