<ul id="menu" class="page-sidebar-menu">
    <li {!! (Request::is('dashboard') ? 'class="active"' : '') !!}>
        <a href="{{ route('dashboard') }}">
            <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>


    <li {!! (Request::is('users') || Request::is('users/create') || Request::is('user_profile') || Request::is('users/*') || Request::is('deleted_users') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Users</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('users') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('users') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Users
                </a>
            </li>
            <li {!! (Request::is('users/create') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('users/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New User
                </a>
            </li>
            <li {!! ((Request::is('users/*')) && !(Request::is('users/create')) ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::route('users.show',Sentinel::getUser()->id) }}">
                    <i class="fa fa-angle-double-right"></i>
                    View Profile
                </a>
            </li>
            <li {!! (Request::is('deleted_users') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('deleted_users') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Deleted Users
                </a>
            </li>
        </ul>
    </li>
    <li {!! (Request::is('roles') || Request::is('roles/create') || Request::is('roles/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Roles</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('roles') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('roles') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Role List
                </a>
            </li>
            <li {!! (Request::is('roles/create') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('roles/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Role
                </a>
            </li>
        </ul>
    </li>

    <!-- Menus generated by CRUD generator -->
    @include('layouts/menu')

</ul>
