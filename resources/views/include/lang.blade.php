<li class="nav-item dropdown text-center" data-toggle="tooltip" data-placement="top" title="{{ __('main.lang') }}">
    <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-language text-lg"></i>
      <span class="nav-link-inner--text d-lg-none">{{ __('main.lang') }}</span>
    </a>

    <div class="dropdown-menu dropdown-menu-lg  dropdown-menu-right  py-0 overflow-hidden">
        <div class="w-100 text-center mt-2">
            <span class="h4 text-center text-dark w-100">{{ __('main.lang') }}</span>
        </div>
      <div class="row shortcuts px-4 justify-content-center">
        <a href="{{ route('language', ['pl']) }}" class="col-4 my-2 shortcut-item text-center">
          <span class="shortcut-media avatar rounded-circle">
            <img src="https://cdn.jsdelivr.net/npm/round-flag-icons/flags/pl.svg" alt="">
          </span>
          <p>
            @if (session('locale') == 'pl')
            <small class="font-weight-700">{{ __('Polski') }}</small>
            @else
            <small>{{ __('Polski') }}</small>
            @endif
          </p>

        </a>
        <a href="{{ route('language', ['en']) }}" class="col-4 my-2 shortcut-item text-center">
          <span class="shortcut-media avatar rounded-circle">
            <img src="https://cdn.jsdelivr.net/npm/round-flag-icons/flags/gb.svg" alt="">
          </span>
          <p>
            @if (session('locale') == 'en')
            <small class="font-weight-700">{{ __('Angielski') }}</small>
            @else
            <small>{{ __('Angielski') }}</small>
            @endif
          </p>
        </a>
        <a href="{{ route('language', ['ua']) }}" class="col-4 my-2 shortcut-item text-center d-none">
            <span class="shortcut-media avatar rounded-circle">
              <img src="https://cdn.jsdelivr.net/npm/round-flag-icons/flags/ua.svg" alt="">
            </span>
            <p>
              @if (session('locale') == 'ua')
              <small class="font-weight-700">{{ __('Ukraiński') }}</small>
              @else
              <small>{{ __('Ukraiński') }}</small>
              @endif
            </p>
          </a>
      </div>
    </div>
  </li>
