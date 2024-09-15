@php
    use Rawilk\Breadcrumbs\Facades\Breadcrumbs;
    use Rawilk\Breadcrumbs\Support\Generator;

    $title = "Tổng hợp bài phân tích game về $tag->name";
    $description = "Cập nhật các bài phân tích game mới nhất về $tag->name";

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

    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="mb-4">
                    {!! Breadcrumbs::render('tag') !!}
                </div>
                <x-shared.heading-title :title="$title" :description="$description" />

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
