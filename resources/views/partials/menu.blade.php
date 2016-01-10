<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('laradmin.welcome') }}">{{ config('laradmin.projectname') }}</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        @if (Auth::guest())
            <li><a href="{{ url('/' . config('laradmin.prefix') . '/login') }}">Login</a></li>

            @if(config('laradmin.can_register'))
                <li><a href="{{ url('/' . config('laradmin.prefix') .'/register') }}">Register</a></li>
            @endif
        @else
            @if(Auth::user()->hasRole('admin'))
                <li>
                    <a href="{{ route('laradmin.users.index') }}">User Management</a>
                </li>
            @endif
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user fa-fw"></i>
                    {{ Auth::user()->name }}
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ url('/' . config('laradmin.prefix') .'/logout') }}"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
    <!-- /.navbar-top-links -->
    @if(auth()->user())
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                {{--<li class="sidebar-search">--}}
                    {{--<div class="input-group custom-search-form">--}}
                        {{--<input type="text" class="form-control" placeholder="Search...">--}}
                                {{--<span class="input-group-btn">--}}
                                    {{--<button class="btn btn-default" type="button">--}}
                                        {{--<i class="fa fa-search"></i>--}}
                                    {{--</button>--}}
                                {{--</span>--}}
                    {{--</div>--}}
                    {{--<!-- /input-group -->--}}
                {{--</li>--}}
                <li>
                    <a href="{{ route('laradmin.welcome') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                @foreach(config('laradmin.menu') as $menu_item_name => $menu_item)
                    @if(isset($menu_item['route']))
                        @if(Auth::user()->hasRole($menu_item['roles']))
                        <li>
                            <a href="{{ route($menu_item['route']) }}">
                                <i class="fa fa-{{ $menu_item['icon'] }} fa-fw"></i>
                                 {{ $menu_item_name }}
                            </a>
                        </li>
                    @endif
                    @else
                        @if(Auth::user()->hasRole($menu_item['roles']))
                        <li>
                            <a href="#">
                                <i class="fa fa-{{ $menu_item['icon'] }} fa-fw"></i>
                                 {{ $menu_item_name }}
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                @foreach($menu_item['submenu'] as $sub_menu_item_name => $submenu_item_route)
                                    <li>
                                        <a href="{{ route($submenu_item_route) }}">{{ $sub_menu_item_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    @endif
    <!-- /.navbar-static-side -->
</nav>