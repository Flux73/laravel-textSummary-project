<nav class="py-6 font-semibold bg-emerald-50">
    <ul class="max-w-6xl mx-auto justify-between flex items-center">
        <li>
            <ul class="flex gap-4">
                <li>
                    <a class="hover:text-emerald-700 transition-all hover:border-b-2 hover:border-emerald-700" href="{{ route('welcome') }}">Welcome</a>
                </li>
                <li>
                    <a class="hover:text-emerald-700 transition-all hover:border-b-2 hover:border-emerald-700" href="{{ route('home') }}">Home</a> 
                </li>
                @if (Auth::check())
                    <li>
                        <a class="hover:text-emerald-700 transition-all hover:border-b-2 hover:border-emerald-700" href="{{ route('profile.edit') }}">Profile</a> 
                    </li>
                @endif
            </ul>     
        </li>
        <li>
            @if (Auth::check())
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-6 py-3 border border-transparent leading-4 font-medium rounded-md text-emerald-50 bg-emerald-700 hover:bg-emerald-800  focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->username }}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
            @else
                <ul class="flex gap-4">
                    <li>
                        <a class="bg-emerald-700 hover:bg-emerald-800 transition-all text-emerald-50 py-2 px-6 rounded-md font-semibold" href="{{ route('register') }}">Sign Up</a> 
                    </li>
                    <li>
                        <a class="ring-2 ring-inset ring-emerald-700 hover:bg-emerald-200 transition-all text-emerald-700 py-2 px-6 rounded-md" href="{{ route('login') }}">Log In</a> 
                    </li>
                </ul>     
            @endif
         </li>
    </ul>
</nav>