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
    @section('description', $image)
    @section('schema')
        {!! Breadcrumbs::view('breadcrumbs::json-ld', 'category') !!}
    @endsection

    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="mb-4">
                    {!! Breadcrumbs::render('category') !!}
                </div>

                <x-shared.heading-title :title="$category->name" :description="$category->description" />

                <div class="grid grid-cols-1 gap-5">
                    @foreach ($posts as $post)
                        <x-blog.card.default :post="$post" />
                    @endforeach
                </div>
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
