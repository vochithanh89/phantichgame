@php
    use Rawilk\Breadcrumbs\Facades\Breadcrumbs;
    use Rawilk\Breadcrumbs\Support\Generator;

    $title = $category->meta_name;
    $description = $category->meta_desc;
    $image = $category->thumbnail_url;
    
    // Home
    Breadcrumbs::for('home', fn (Generator $trail) => $trail->push('Trang chủ', '/'));
    Breadcrumbs::for(
        'blog',
        fn (Generator $trail) => $trail->parent('home')->push('Bài viết', route('blog.index'))
    );
    Breadcrumbs::for(
        'category',
        fn (Generator $trail) => $trail->parent('blog')->push($category->name)
    );
    
@endphp

<x-app-layout>
    @section('title', $title)
    @section('description', $description)
    @section('image', $image)
    @section('schema')
        {!! Breadcrumbs::view('breadcrumbs::json-ld', 'category') !!}
    @endsection

    <div class="mb-8">
        <x-shared.hero-heading :title="$category->name" :description="$category->description" :image="$category->thumbnail_url" />
    </div>

    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <x-shared.title :title="$category->name" />
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
