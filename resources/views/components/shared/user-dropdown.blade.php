@if (Auth::check())
    <div class="relative">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex text-sm rounded-full border transition">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    Hello, {{ Auth::user()->name }}
                </div>


                @if (Auth::user()->can('access-panel'))
                    <x-dropdown-link href="/admin">
                        Admin
                    </x-dropdown-link>
                @endif

                <div class="border-t border-gray-200"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        Logout
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
@else
    @if (!App::environment('production'))
        <div>
            <a href="{{ route('login') }}"
                class="px-4 py-2 text-sm font-semibold bg-primary-500 text-white rounded-sm uppercase">
                Đăng nhập
            </a>
        </div>
    @endif
@endif
