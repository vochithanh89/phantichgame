

<x-app-layout>
    {{-- @section('title', 'Hello')
    @section('description', 'desc') --}}

    <x-home.section.hero />

    <div class="container space-y-12">
        <div>
            <x-shared.title title="Phổ biến trên Phân Tích Game" />
            <x-blog.section.popular :posts="$popularPosts" />
        </div>

        <div>
            <x-shared.title title="Nổi bật trong tháng" />
            <x-blog.section.priority :posts="$popularMonthPosts" />
        </div>

        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-full lg:col-span-8">
                <x-shared.title title="Dành cho bạn" />
                <x-blog.section.default :posts="$newestPosts" />
                @if (count($newestPosts) === 24)
                    <div class="mt-4 flex justify-center">
                        <a href="{{ route('blog.index') }}" class="px-6 py-1.5 rounded-full border border-primary text-sm text-primary font-medium transition-all">
                            Xem tất cả
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-span-full lg:col-span-4">
                <x-shared.sidebar />
            </div>
        </div>
    </div>

</x-app-layout>
