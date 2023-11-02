<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset("dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Ecommerce</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @if(Auth::check())
            <div class=" mt-3 pb-3 d-flex justify-center">
                <div class="image">
                    @if($user->profile->image)
                    <a href="{{asset('storage/' . $user->profile->image)}}">
                        <img src="{{asset("storage/" . $user->profile->image)}}" class="rounded-full w-36 h-34" alt=" Image">
                    </a>
                    @else
                        {{--
                        TODO
                        make an avatar for the user if he didn't update his profile

                        --}}
                    @endif
                </div>
            </div>
            <div class="info text-center mb-3">
                <a href="{{route("dashboard.profile.edit")}}"
                   class="d-block font-weight-bold">
                    @if($user->profile->first_name && $user->profile->last_name)
                    {{$user->profile->first_name . " " . $user->profile->last_name}}
                    @else
                        {{Auth::user()->name}}
                    @endif
                </a>
            </div>
        @endif

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
{{--        @include('layouts.partials.nav')--}}
        <x-nav context="side"/>
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @section('breadcrumb')
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        @show
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @yield('content')
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
