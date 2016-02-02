<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ "https://secure.gravatar.com/avatar/" . md5( strtolower( trim( Auth::user()->email ) ) ) . "?d=mm" . "&s=45" }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>

            <li class="{{ Request::url() == route('laradmin.welcome') ? 'active': '' }}"><a href="{{ route('laradmin.welcome') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

            @foreach(config('laradmin.side_menu') as $title => $parameters)
                @if($parameters["type"] == 'item')
                    @if($parameters['controller'])
                    <li class="{{ active_class(current_controller() == $parameters['controller']) }}">
                        <a href="{{ isset($parameters['route']) ? route($parameters['route']) : url($parameters['url']) }}">
                            <i class="fa fa-{{$parameters["icon"]}}"></i>
                            <span>{{ $title }}</span>
                        </a>
                    </li>
                    @else
                        <li class="{{ active_class(current_controller() == $parameters['route']) }}">
                            <a href="{{ isset($parameters['route']) ? route($parameters['route']) : url($parameters['url']) }}">
                                <i class="fa fa-{{$parameters["icon"]}}"></i>
                                <span>{{ $title }}</span>
                            </a>
                        </li>
                    @endif
                @elseif($parameters["type"] == 'submenu')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-{{ $parameters['icon'] }}"></i>
                            <span>{{ $title }}</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            @foreach($parameters["submenu"] as $secont_title => $second_parameters)
                                <li class="{{ Request::url() == (isset($second_parameters['route']) ? route($second_parameters['route']) : url($second_parameters['url'])) ? 'active' : '' }}">
                                    <a href="{{ isset($second_parameters['route']) ? route($second_parameters['route']) : url($second_parameters['url']) }}">
                                        <i class="fa fa-{{ $second_parameters['icon'] }}"></i>
                                        <span>{{ $secont_title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach

            @if(Auth::user()->can(['manage_users', 'manage_roles', 'manage_permissions']))
                <li class="header">ADMINISTRATOR</li>
                @if(Auth::user()->can('manage_users'))
                    <li class="{{ active_class(current_controller() == '\MatthC\Laradmin\Http\Controllers\UsersController')  }}">
                        <a href={{ route('laradmin.users.index') }}>
                            <i class="fa fa-user"></i> <span>Users</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('manage_roles'))
                    <li class="{{ active_class(current_controller() == '\MatthC\Laradmin\Http\Controllers\RolesController') }}">
                        <a href="{{ route('laradmin.roles.index') }}">
                            <i class="fa fa-link"></i> <span>Roles</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('manage_permissions'))
                    <li class="{{ active_class(current_controller() == '\MatthC\Laradmin\Http\Controllers\PermissionsController') }}">
                        <a href="{{ route('laradmin.permissions.index') }}">
                            <i class="fa fa-key"></i> <span>Permissions</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- =============================================== -->