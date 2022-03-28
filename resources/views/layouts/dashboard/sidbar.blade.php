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
            <li class="sidebar-item  has-sub {{ Request::segment(3) == 'users' ? 'active' : '' }}
            {{ Request::segment(4) == 'create' && Request::segment(3) == 'users' ? 'active' : '' }}
            {{ Request::segment(5) == 'edit' && Request::segment(3) == 'users'? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="fa fa-user"></i>
                    <span>Users</span>
                </a>
                @if(auth()->user()->hasPermission('users_create'))
                <ul class="submenu ">
                    <li class="submenu-item {{ Request::segment(3) == 'users' ? 'active' : '' }}">

                        <a href="{{route('users.index')}}"> <i class="fas fa-user"></i> users</a>
                    </li>
                    <li class="submenu-item request()->routeIs('users.create') ? 'active' : '' }}">
                        <a href="{{route('users.create')}}"><i class="fas fa-user-plus"></i> create user</a>
                    </li>
                </ul>
                @endif
            </li>
            @endif
            @endif



            @if(auth()->user())
                @if(auth()->user()->hasPermission('categories_read'))
                    <li class="sidebar-item  has-sub {{ Request::segment(3) == 'categories' ? 'active' : '' }}
                    {{ Request::segment(4) == 'create' && Request::segment(3) == 'categories' ? 'active' : '' }}
                    {{ Request::segment(5) == 'edit'  && Request::segment(3) == 'categories' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="fa fa-archive"></i>
                            <span>categories</span>
                        </a>
                        @if(auth()->user()->hasPermission('categories_create'))
                            <ul class="submenu ">
                                <li class="submenu-item {{ Request::segment(3) == 'categories' ? 'active' : '' }}">
                                    <a href="{{route('categories.index')}}"><i class="fas fa-archive"></i>  categories</a>
                                </li>
                                <li class="submenu-item request()->routeIs('categories.create') ? 'active' : '' }}">
                                    <a href="{{route('categories.create')}}"><i class="fas fa-plus-square"></i>  create category</a>
                                </li>
                            </ul>
                        @endif
                    </li>
                @endif
            @endif


            @if(auth()->user())
                @if(auth()->user()->hasPermission('products_read'))
                    <li class="sidebar-item  has-sub {{ Request::segment(3) == 'products' ? 'active' : '' }}
                    {{ Request::segment(4) == 'create' && Request::segment(3) == 'products' ? 'active' : '' }}
                    {{ Request::segment(5) == 'edit'  && Request::segment(3) == 'products' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="fa fa-product-hunt"></i>
                            <span>products</span>
                        </a>
                        @if(auth()->user()->hasPermission('products_create'))
                            <ul class="submenu ">
                                <li class="submenu-item {{ Request::segment(3) == 'products' ? 'active' : '' }}">
                                    <a href="{{route('products.index')}}">products</a>
                                </li>
                                <li class="submenu-item request()->routeIs('products.create') ? 'active' : '' }}">
                                    <a href="{{route('products.create')}}">create products</a>
                                </li>
                            </ul>
                        @endif
                    </li>
                @endif
            @endif




            @if(!auth()->user())
            <li class="sidebar-item">
                <i class="fa-regular fa-arrow-right-to-bracket"></i>
                <a href="{{ route('login') }}" rel="alternate" class="dropdown-item"><span>Login</span></a>
            <li>
            @endif

            @if(auth()->user())
            <li class="sidebar-item">
                <form method="POST" action="/logout" class="">
                    @csrf
                    <button class="btn btn-light-secondary" style="background: #ffffff" type="submit"><span>       <i class="fa fa-power-off "></i> LogOut</span>
                        </button>
                </form>
            </li>
            @endif
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
