<nav x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="navbar navbar-expand-sm bg-body-tertiary ps-2">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('img/icon.jpg') }}" width="30" height="24" alt="ZuSa" class="d-inline-block align-text-top">
                ZuSa
            </a>

            <!-- Hamburger -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarId" aria-controls="navbarId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>                    

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarId">
                <ul class="navbar-nav">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('vendors.index')" :active="request()->routeIs('vendors.index')">
                        {{ __('Vendors') }}
                    </x-nav-link>
                    <x-nav-dropdown>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('Administration') }}
                        </a>
                        <ul class="dropdown-menu">
                            <x-nav-dropdown-link :href="route('users.index')">
                                {{ __('Users') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('dimensions.index')">
                                {{ __('Dimensions') }}
                            </x-nav-dropdown-link>
                        </ul>                                
                    </x-nav-dropdown>
                </ul>               
                <ul class="navbar-nav ms-auto">
                    <x-nav-dropdown>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <x-nav-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-nav-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-nav-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-nav-dropdown-link>
                            </form>
                        </ul>                                
                    </x-nav-dropdown>
                </ul>
            </div>
            </div>
        </div>
    </div>
</nav>
