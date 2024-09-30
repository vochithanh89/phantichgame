<div class="container">
    <div class="pt-4 sm:pt-10 border-t">
        <div class="mb-8 flex flex-wrap lg:flex-nowrap justify-between items-end">
            <div class="max-w-xl">
                <!-- logo - start -->
                <div class="mb-2 lg:-mt-2">
                    <a href="/" class="inline-flex items-center gap-2 text-xl font-bold text-black md:text-2xl"
                        aria-label="logo">
                        <x-shared.logo-text class="mt-4 h-8" />
                    </a>
                </div>
                <!-- logo - end -->
                <p class="text-gray-500 sm:pr-8 mb-4 lg:mb-0">
                    <a href="/" class="text-primary">{{ config('app.name') }}</a>
                    - {{ config('app.description') }}
                </p>
            </div>
            <div>
                <a target="_blank" href="//www.dmca.com/Protection/Status.aspx?ID=17608ed7-04d1-4d92-bff4-c5eff17c4eb1" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/dmca_protected_16_120.png?ID=17608ed7-04d1-4d92-bff4-c5eff17c4eb1"  alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
            </div>
        </div>

        <div class="border-t py-8">
            <div class="text-sm text-gray-500 dark:text-gray-400">
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
                by <span class="text-primary">{{ config('app.name') }}</span> - Powered by <span
                    class="text-primary">{{ config('app.name') }}</span>.
            </div>
            <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                © 2024 {{ config('app.name') }}. All Rights Reserved.
            </div>
        </div>
    </div>
</div>
