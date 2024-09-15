<footer>
    <div class="container">
        <div class="pt-4 sm:pt-10 border-t">
            <div class="mb-8 flex flex-wrap lg:flex-nowrap justify-between items-end">
                <div class="max-w-xl">
                    <!-- logo - start -->
                    <div class="mb-2 lg:-mt-2">
                        <a href="/" class="inline-flex items-center gap-2 text-xl font-bold text-black md:text-2xl"
                            aria-label="logo">
                            <x-shared.logo class="mt-4 h-20" />
                        </a>
                    </div>
                    <!-- logo - end -->
                    <p class="text-gray-500 sm:pr-8 mb-4 lg:mb-0">
                        <a href="/" class="text-primary">{{ config('app.name') }}</a> - {{ config('app.description') }}
                    </p>
                </div>
            
                <div class="flex flex-wrap justify-start gap-2 lg:pl-28">
                    @foreach ($categories as $category)
                        <a href="/"
                            class="badge text-sm px-4 py-1 rounded">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <div class="border-t py-8 text-center">
                <div class="text-sm text-gray-500 text-center dark:text-gray-400">
                    Designed and coded with
                    <svg class="inline" width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M2 9.1371C2 14 6.01943 16.5914 8.96173 18.9109C10 19.7294 11 20.5 12 20.5C13 20.5 14 19.7294 15.0383 18.9109C17.9806 16.5914 22 14 22 9.1371C22 4.27416 16.4998 0.825464 12 5.50063C7.50016 0.825464 2 4.27416 2 9.1371Z"
                                fill="#fa0000"></path>
                        </g>
                    </svg>
                    by <span class="text-primary">{{ config('app.name') }}</span> - Powered by <span class="text-primary">{{ config('app.name') }}</span>.
                </div>
                <div class="mt-1 text-sm text-gray-500 text-center dark:text-gray-400">
                    © 2024 {{ config('app.name') }}. All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
</footer>
