<form action="{{ route('blog.viewSearch') }}">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">
        Tìm kiếm
    </label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <i class="fa-regular fa-magnifying-glass text-gray-500 dark:text-gray-400"
                data-src="/icon/svgs/regular/magnifying-glass.svg"><svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    style="display: inline-block; overflow: visible; box-sizing: content-box; fill: currentcolor; height: 1em; vertical-align: -0.125em;">
                    <path
                        d="M368 208A160 160 0 1 0 48 208a160 160 0 1 0 320 0zM337.1 371.1C301.7 399.2 256.8 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 48.8-16.8 93.7-44.9 129.1L505 471c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L337.1 371.1z">
                    </path>
                </svg></i>
        </div>
        <input type="text" id="default-search"
            class="block w-full p-4 pl-10 pr-24 border-gray-200 rounded-md text-sm border focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
            name="q" placeholder="Nhập bất kỳ từ khoá..." required="">
        <button type="submit"
            class="text-white absolute right-2.5 bottom-2.5 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Tìm kiếm
        </button>
    </div>
</form>
