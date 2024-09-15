<div class="fixed inset-0 top-14 bg-white px-4 py-8">
    <p class="mb-6 text-content font-bold">
        Chuyên mục
    </p>
    <ul class="flex flex-col gap-6">
        @foreach ($categories as $category)
            <li x-data="{ showDropdown: false }" class="border-b pb-2">
                <div class="flex items-center justify-between">
                    <a class="text-default hover:text-primary text-lg font-bold transition-all" href="{{ $category->url }}">
                        {{ $category->name }}
                    </a>
                    @if (count($category->childs) > 0) 
                        <button @click="showDropdown = !showDropdown">
                            <x-carbon-chevron-down class="w-6 h-6 text-content transition-all" x-bind:class="showDropdown ? 'rotate-180' : ''" />
                        </button>
                    @endif
                </div>
                <div x-cloak x-show="showDropdown" class="mt-2">
                    @foreach ($category->childs as $categoryChild)
                        <a href="{{ $categoryChild->url }}" class="block py-2 text-content hover:text-primary transition-all">
                            {{ $categoryChild->name }}
                        </a>
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>
</div>
