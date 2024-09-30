@php
    use Rawilk\Breadcrumbs\Facades\Breadcrumbs;
    use Rawilk\Breadcrumbs\Support\Generator;

    $title = 'Bài viết phân tích phim mới nhất';
    $description = 'Các bài phân tích phim, review phim, dự đoán phim, tổng hợp phim hay mới nhất trên Phân Tích Game';
    
    // Home
    Breadcrumbs::for('home', fn (Generator $trail) => $trail->push('Trang chủ', '/'));
    Breadcrumbs::for(
        'blog',
        fn (Generator $trail) => $trail->parent('home')->push($title)
    );
@endphp

<x-app-layout>
    @section('title', $title)
    @section('description', $description)
    @section('schema')
        {!! Breadcrumbs::view('breadcrumbs::json-ld', 'blog') !!}
    @endsection

    <div class="mb-8">
        <x-shared.hero-heading :title="$title" :description="$description" />
    </div>

    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <x-shared.title title="Bài viết mới nhất" />
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
