<form action="{{ route('blog.viewSearch') }}">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">
        Tìm kiếm
    </label>
    <div class="relative">
        <input type="text" id="default-search"
            class="block w-full p-4 pr-10 bg-gray-100 border-none rounded-md text-sm border focus:border-none focus:ring-0 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
            name="q" placeholder="Nhập bất kỳ từ khoá..." required="">

        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <i class="fa-regular fa-magnifying-glass text-gray-500 dark:text-gray-400"
                data-src="/icon/svgs/regular/magnifying-glass.svg"><svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    style="display: inline-block; overflow: visible; box-sizing: content-box; fill: currentcolor; height: 1em; vertical-align: -0.125em;">
                    <path
                        d="M368 208A160 160 0 1 0 48 208a160 160 0 1 0 320 0zM337.1 371.1C301.7 399.2 256.8 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 48.8-16.8 93.7-44.9 129.1L505 471c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L337.1 371.1z">
                    </path>
                </svg></i>
        </div>
    </div>
</form>
