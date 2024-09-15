<nav class="sticky top-0 bg-primary-600 z-40 hidden lg:block shadow-card">
    <div class="container">
        <div class="flex items-center -mx-2 bg-primary-600">
            <div class="group text-white">
                <a href="/" class="px-2 py-3 block text-sm font-semibold uppercase transition-all">
                    <x-carbon-home class="inline-block w-6" />
                </a>
            </div>
            @foreach ($categories as $category)
                <div class="group relative text-white hover:text-primary-200">
                    <a href="{{ $category->url }}" class="px-4 py-3.5 block text-sm uppercase font-bold transition-all">
                        {{ $category->name }}
                    </a>
                    @if (count($category->childs) > 0)     
                        <div class="absolute top-full left-0 w-60 divide-y bg-white shadow-card rounded-sm border-t-2 border-primary-700 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all z-50">
                            @foreach ($category->childs as $categoryChild)
                                <a href="{{ $categoryChild->url }}" class="block px-4 py-2.5 text-default hover:text-primary text-sm font-medium transition-all">
                                    {{ $categoryChild->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</nav>