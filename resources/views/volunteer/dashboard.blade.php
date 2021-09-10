@extends('layouts.volunteer')

@section('title') {{ __('admin.main.dashboard.title') }} @endsection

@section('sidebar')

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center pb-2 mb-1" href="{{ route('v.dashboard') }}">
        <div class="sidebar-brand-icon">
                  <img src="https://panel.wolontariat.rybnik.pl/assets/img/mosir1.svg">
              </div>
      <div class="sidebar-brand-text">
          <img src="https://panel.wolontariat.rybnik.pl/assets/img/mosir2.svg">
          </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('v.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('admin.main.sidebar.dashboard') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#messages"
            aria-expanded="true" aria-controls="admins">
            <i class="fas fa-fw fa-inbox"></i>
            <span>{{ __('admin.main.sidebar.messages.messages') }}</span>
        </a>
        <div id="messages" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('admin.main.sidebar.action') }}:</h6>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.messages.list') }}</a>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.messages.new') }}</a>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.messages.send') }}</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        {{ __('admin.main.sidebar.headers.u') }}
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admins"
            aria-expanded="true" aria-controls="admins">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>{{ __('admin.main.sidebar.adm.title') }}</span>
        </a>
        <div id="admins" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('admin.main.sidebar.action') }}:</h6>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.adm.search') }}</a>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.adm.list') }}</a>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.adm.create') }}</a>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.adm.birthday') }}</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        {{ __('admin.main.sidebar.headers.m') }}
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#forms"
            aria-expanded="true" aria-controls="forms">
            <i class="fas fa-fw fa-list"></i>
            <span>{{ __('admin.main.sidebar.form.title') }}</span>
        </a>
        <div id="forms" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('admin.main.sidebar.action') }}:</h6>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.form.list') }}</a>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.form.search') }}y</a>
                <a class="collapse-item" href="">{{ __('admin.main.sidebar.form.create') }}</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        {{ __('admin.main.sidebar.headers.other') }}
    </div>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{ __('admin.main.sidebar.others.settings') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>{{ __('admin.main.sidebar.others.calendar') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-info"></i>
            <span>{{ __('admin.main.sidebar.others.info') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>{{ __('admin.main.sidebar.others.logout') }}</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

@endsection



@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('admin.main.dashboard.title') }}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Example button</a>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{ __('admin.main.dashboard.your_id') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->id }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-id-card-alt fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{ __('admin.main.dashboard.v_count') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                </div>
                <div class="col-auto">
                    <a href=""><i class="fas fa-users fa-2x text-gray-300"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{ __('admin.main.dashboard.c_count') }}</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <a href=""><i class="fas fa-users fa-2x text-gray-300"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{ __('admin.main.dashboard.o_count') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                </div>
                <div class="col-auto">
                    <a href=""><i class="fas fa-sitemap fa-2x text-gray-300"></i></a>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Example text</h6>
              <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                  <div class="dropdown-header">Działania</div>
                  <a class="dropdown-item" href="#"></a>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    {{ App::currentLocale() }}
                </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-lg-5">
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Example text</h6>
              <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                  <div class="dropdown-header">Działania</div>
                  <a class="dropdown-item" href="#">Przejdź do listy</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="chart-area">

              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

