<nav x-data="{ open: false }" class="bg-gray-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left: Logo + Navigation -->
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="w-20 h-20 fill-current text-cyan-400 block h-9 w-auto text-lime-400" />
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-4">
                    @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-white hover:text-lime-400 transition">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"
                        class="text-white hover:text-lime-400 transition">
                        {{ __('Edit Profile') }}
                    </x-nav-link>

                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')"
                        class="text-white hover:text-lime-400 transition">
                        {{ __('Posts') }}
                    </x-nav-link>

                    @if (auth()->user()->is_admin)
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                        class="text-white hover:text-lime-400 transition">
                        {{ __('Admin Dashboard') }}
                    </x-nav-link>
                    @endif
                    @endauth
                </div>
            </div>

            <!-- Right: Profile + Auth -->
            <div class="hidden sm:flex items-center gap-4">
                @auth
                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                    alt="Profile" class="w-10 h-10 rounded-full object-cover border border-lime-400 shadow-sm">

                <span class="text-sm text-white">{{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-400 hover:text-red-300 transition">
                        {{ __('Log Out') }}
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="text-sm text-lime-400 hover:underline">Log In</a>
                <a href="{{ route('register') }}" class="text-sm text-lime-400 hover:underline">Register</a>
                @endauth
            </div>

            <!-- Mobile Button -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open"
                    class="p-2 rounded-md text-white hover:text-lime-400 hover:bg-gray-800 transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown -->
    <div x-show="open" x-transition class="sm:hidden bg-gray-800 text-white shadow-inner border-t border-gray-700">
        <div class="pt-4 pb-3">
            <div class="flex items-center px-4 gap-4">
                <img src="{{ Auth::check() ? asset('storage/' . Auth::user()->profile_image) : asset('storage/profile_images/default-user.jpg') }}"
                    alt="Profile" class="h-9 w-9 rounded-full object-cover border border-lime-400 shadow-sm">
                <div>
                    <div class="font-semibold text-lime-400">
                        {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                    </div>
                    <div class="text-sm text-gray-400">
                        {{ Auth::check() ? Auth::user()->email : 'guest@example.com' }}
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="text-white hover:text-lime-400 transition">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                @auth
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="text-white hover:text-lime-400 transition">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('posts.index')"
                    class="text-white hover:text-lime-400 transition">
                    {{ __('Posts') }}
                </x-responsive-nav-link>

                @if (auth()->user()->is_admin)
                <x-responsive-nav-link :href="route('admin.dashboard')"
                    class="text-white hover:text-lime-400 transition">
                    {{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-400 hover:text-red-300 transition">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                @else
                <x-responsive-nav-link :href="route('login')" class="text-lime-400 hover:underline">
                    {{ __('Log In') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="text-lime-400 hover:underline">
                    {{ __('Register') }}
                </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>