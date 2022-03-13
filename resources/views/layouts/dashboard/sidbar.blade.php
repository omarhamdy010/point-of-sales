<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="{{route('dashboard.index')}}"><img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo"
                                                            srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="tab-pane">
                <p style="font-size: 15px">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</p>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item {{ request()->routeIs('dashboard.index')? 'active' : '' }}">
                <a href="{{route('dashboard.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->hasPermission('users_read'))
                <li class="sidebar-item {{ request()->routeIs('users.index') ? 'active' : '' }}
                {{ request()->routeIs('users.create') ? 'active' : '' }}">
                    <a href="{{route('users.index')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>users</span>
                    </a>
                </li>
            @endif
            @if(auth()->user()->hasPermission('categories_read'))
                <li class="sidebar-item {{ request()->routeIs('categories.index') ? 'active' : '' }}
                {{ request()->routeIs('categories.create') ? 'active' : '' }}">
                    <a href="{{route('categories.index')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>categories</span>
                    </a>
                </li>
            @endif


        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
