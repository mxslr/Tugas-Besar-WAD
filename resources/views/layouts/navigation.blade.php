{{-- resources/views/layouts/navigation.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo width="30" height="24" class="d-inline-block align-text-top" />
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>

                {{-- Menu untuk Mahasiswa & Dosen --}}
                @if(Auth::user()->role == 'mahasiswa' || Auth::user()->role == 'dosen')
                <li class="nav-item">
                    <x-nav-link :href="route('bookings.create')" :active="request()->routeIs('bookings.create')" class="nav-link">
                        {{ __('Buat Booking') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('bookings.my')" :active="request()->routeIs('bookings.my')" class="nav-link">
                        {{ __('Booking Saya') }}
                    </x-nav-link>
                </li>
                @endif

                {{-- Menu untuk Admin --}}
                @if(Auth::user()->role == 'admin')
                <li class="nav-item">
                    <x-nav-link :href="route('admin.rooms.index')" :active="request()->routeIs('admin.rooms.*')" class="nav-link">
                        {{ __('Manajemen Ruangan') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('admin.bookings.index')" :active="request()->routeIs('admin.bookings.*')" class="nav-link">
                        {{ __('Approval Booking') }}
                    </x-nav-link>
                </li>
                @endif
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->username }} ({{ ucfirst(Auth::user()->role) }})
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profil') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>