@php
    use App\Models\BlogPost;

    $title = 'Không tìm thấy trang bạn yêu cầu';
    $description = 'Bài viết thể thao, esport hôm nay mới nhất trong ngày';

    $posts = BlogPost::getNewestPosts(24);
@endphp

<x-app-layout>
    @section('title', $title)
    @section('description', $description)

    <div class="container">
        <div class="my-24 w-full">
            <div class="flex flex-col items-center">
                <p class="mb-4 text-sm font-semibold uppercase text-primary-500 md:text-base">
                    That’s a 404
                </p>
                <h1 class="mb-2 text-center text-2xl font-bold text-gray-800 md:text-3xl">
                    Không tìm thấy trang
                </h1>
                <p class="mb-12 max-w-screen-md text-center text-gray-500 md:text-lg">
                    Trang bạn đang tìm kiếm không tồn tại.
                </p>
                <a href="/"
                    class="inline-block rounded-lg bg-gray-200 px-8 py-3 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-300 focus-visible:ring active:text-gray-700 md:text-base">
                    Trở về trang chủ
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">
                <x-shared.heading-title title="Bài viết mới nhất có thể bạn đang tìm kiếm" :description="$description" />
                <div class="grid grid-cols-1 gap-5">
                    @foreach ($posts as $post)
                        <x-blog.card.default :post="$post" />
                    @endforeach
                </div>
            </div>
            <div>
                <x-shared.sidebar />
            </div>
        </div>
    </div>

</x-app-layout>
