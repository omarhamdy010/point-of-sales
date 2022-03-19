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
        @if(auth()->user())
        <div class="d-flex justify-content-between">
            <div class="tab-pane">
                <p style="font-size: 15px">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</p>
            </div>
        </div>
        @endif
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item {{ Request::segment(3) == 'dashboard'? 'active' : '' }}">
                <a href="{{route('dashboard.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @if(auth()->user())
            @if(auth()->user()->hasPermission('users_read'))
                <li class="sidebar-item {{ Request::segment(3) == 'users' ? 'active' : '' }}
                {{ request()->routeIs('users.create') ? 'active' : '' }}">
                    <a href="{{route('users.index')}}" class='sidebar-link'>
                        <i class="fa fa-users"></i>
                        <span>users</span>
                    </a>
                </li>
            @endif
            @endif


            @if(auth()->user())
            @if(auth()->user()->hasPermission('categories_read'))
                <li class="sidebar-item {{ Request::segment(3) == 'categories'? 'active' : '' }}
                {{ request()->routeIs('categories.create') ? 'active' : '' }}">
                    <a href="{{route('categories.index')}}" class='sidebar-link'>
                        <i class="fa fa-archive"></i>
                        <span>categories</span>
                    </a>
                </li>
            @endif
            @endif



            @if(auth()->user())
            @if(auth()->user()->hasPermission('products_read'))
                <li class="sidebar-item {{ Request::segment(3) == 'products' ? 'active' : '' }}
                {{ request()->routeIs('products.create') ? 'active' : '' }}">
                    <a href="{{route('products.index')}}" class='sidebar-link'>
                        <i class="fa fa-archive"></i>
                        <span>products</span>
                    </a>
                </li>
            @endif

            @endif

            @if(!auth()->user())
            <li class="sidebar-item">
                <a href="{{ route('login') }}" rel="alternate" class="dropdown-item"><span>Login</span></a>
            <li>
            @endif

            @if(auth()->user())
            <li class="sidebar-item">
                <form method="POST" action="/logout" class="">
                        @csrf
                        <button class="btn btn-light-secondary" style="background: #ffffff" type="submit"><span>Log Out</span>
                        </button>
                </form>
            </li>
            @endif
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
