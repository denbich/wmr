<li class="nav-item">
    <a class="nav-link" href="{{ route('v.calendar') }}">
        <i class="far fa-calendar text-primary"></i>
        <span class="nav-link-text">{{ __('volunteer.sidebar.calendar') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('v.settings') }}">
        <i class="fas fa-cog text-primary"></i>
        <span class="nav-link-text">{{ __('volunteer.menu.dropdown.settings') }}</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('v.info') }}">
        <i class="fas fa-info-circle text-primary"></i>
        <span class="nav-link-text">{{ __('volunteer.sidebar.info') }}</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt text-primary"></i>
        <span class="nav-link-text">{{ __('main.logout') }}</span>
    </a>
</li>
