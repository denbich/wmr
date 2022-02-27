@guest
    <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link text-center">
            <span class="nav-link-inner--text">{{ __('main.login') }}</span>
        </a>
    </li>
@endguest
@auth
    @switch(Auth::user()->role)
        @case('volunteer')
            <li class="nav-item">
                <a href="{{ route('v.dashboard') }}" class="nav-link text-center">
                    <span class="nav-link-inner--text">{{ __('Lista Irganizacji') }}</span>
                </a>
            </li>
        @break
        @case('coordinator')
            <li class="nav-item">
                <a href="{{ route('c.dashboard') }}" class="nav-link text-center">
                    <span class="nav-link-inner--text">{{ __('Panel Koordynatora') }}</span>
                </a>
            </li>
        @break
        @case('admin')
            <li class="nav-item">
                <a href="{{ route('a.dashboard') }}" class="nav-link text-center">
                    <span class="nav-link-inner--text">{{ __('Panel Administratora') }}</span>
                </a>
            </li>
        @break
    @endswitch
    <li class="nav-item">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-center">
            <span class="nav-link-inner--text">{{ __('main.logout') }}</span>
        </a>
    </li>
@endauth
