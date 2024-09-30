@php
    use App\Models\BlogCategory;

    $categories = BlogCategory::where(['is_published' => 1])
        ->where(['parent_id' => null])
        ->take(20)
        ->get();

@endphp

<nav class="py-4 bg-white shadow-card">
    <div 
        x-data="{
            isSearch: false,
            isOpenNav: false,
        }" 
        class="container"
    >
        <template x-if="!isSearch">
            <div class="flex items-center justify-between">
                <div class="flex justify-between items-center">
                    <a href="/" alt="{{ config('app.name') }}" class="mr-8">
                        <x-shared.logo-text class="h-8" />
                    </a>

                    <div class="gap-4 hidden lg:flex">
                        @foreach ($categories as $category)
                            <a href="{{ $category->url }}" class="text-sm font-medium text-default hover:text-primary transition-all">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
    
                    <div x-show="isOpenNav" x-transition.opacity class="fixed inset-0 gap-4 z-50">
                        <div @click="isOpenNav=false" class="absolute inset-0 w-full h-full bg-black/40"></div>
                        <div class="relative px-4 py-6 w-2/3 h-full bg-white z-10">
                            <div class="mb-12 flex gap-4">
                                <button type="button" class="lg:hidden text-gray-500 transition-all" >
                                    <x-heroicon-s-x-mark @click="isOpenNav=false" class="size-6" />
                                </button>
                                <a href="/" alt="{{ config('app.name') }}">
                                    <x-shared.logo-text class="h-8" />
                                </a>
                            </div>
                            <div class="flex flex-col gap-4">
                                @foreach ($categories as $category)
                                    <a href="{{ $category->url }}" class="text-lg font-medium text-gray-500 hover:text-primary transition-all">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button @click="isSearch = true" type="button" class="text-gray-500 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-all">
                        <x-heroicon-s-magnifying-glass class="size-6" />
                    </button>
                    
                    <button type="button" class="lg:hidden text-gray-500 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-all" >
                        <x-heroicon-o-bars-3 @click="isOpenNav=true" class="size-6" />
                    </button>

                    <div>
                        <x-shared.user-dropdown />
                    </div>
                </div>
            </div>
        </template>
        <template x-if="isSearch">
            <div class="flex items-center gap-4 h-8">
                <button type="button" @click="isSearch = false" class="text-gray-500 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-all">
                    <x-heroicon-o-arrow-small-left class="size-6" />
                </button>
                <div class="flex-1">
                    <x-shared.search-form />
                </div>
            </div>
        </template>
    </div>
</nav>