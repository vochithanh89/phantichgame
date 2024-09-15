<nav class="bg-white">
    <div class="container">
        <div class="block lg:flex items-center justify-between py-2">
            <div x-data="{ isOpen: false }" class="flex justify-between items-center lg:items-start lg:flex-col">
                <a href="/" alt="{{ config('app.name') }}">
                    <x-shared.logo-text class="h-12 lg:h-16" />
                </a>
                <span class="flex-1 text-end text-primary text-white">
                    {{-- {{ (new \Jenssegers\Date\Date('now', 'Asia/Bangkok'))->format('D, H:i d/m/Y'); }} --}}
                </span>
                <button x-on:click="isOpen=!isOpen" class="text-primary ml-3 lg:hidden" title="nav-button" type="button">
                    <span x-cloak x-show="!isOpen">
                        <x-heroicon-s-bars-3 class="w-8" />
                    </span>
                    <span x-cloak x-show="isOpen">  
                        <x-heroicon-o-x-mark class="w-8" />
                    </span> 
                </button>
                <div x-cloak x-show="isOpen">
                    @include('/layouts/partials/category-navbar-mobile', [
                        'categories' => $categories
                    ])
                </div>
            </div>
            <div class="items-center gap-4 hidden lg:flex">
                <div>
                    
                </div>
                @if (Auth::check())
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (true)
                                    <button class="flex text-sm rounded-full transition">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Hello, {{ Auth::user()->name }}
                                </div>

                                @if (Auth::user()->can('access-panel'))
                                    <x-dropdown-link href="/admin">
                                        {{ __('Admin') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                            @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    {{-- <div class="">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold bg-primary-500 text-white rounded-sm uppercase">
                            Đăng nhập
                        </a>
                    </div> --}}
                @endif
                
            </div>
        </div>
    </div>
</nav>