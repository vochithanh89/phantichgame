<x-app-layout>
    {{-- @section('title', 'Hello')
    @section('description', 'desc') --}}

    <h1 class="hidden">
        {{ config('app.title') }}
    </h1>
    <h2 class="hidden">
        Tin thể thao mới cập nhật
    </h2>
    
    <div class="container space-y-16">
        <x-blog.sections.hero :posts="$newestPosts" />
        {{-- <x-blog.sections.tag /> --}}
        <x-blog.sections.trending :posts="$popularPosts" />
        <x-blog.sections.editor-pick :posts="$priorityPosts" />
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <x-blog.sections.list :posts="$newestPosts" />
            </div>
            <div>
                <x-shared.sidebar />
            </div>
        </div>
    </div>

</x-app-layout>
