<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('assets/images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle
        elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/images/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview {{in_array(\Route::currentRouteName() ,  ['admin.dropdown1','admin.dropdown2']) ? 'menu-open': '' }}">
                    <a href="#"
                       class="nav-link {{in_array(\Route::currentRouteName() , ['admin.dropdown1','admin.dropdown2']) ? 'active': ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Legördülő menü teszt
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.dropdown1')}}"
                               class="nav-link {{\Route::currentRouteName()== "admin.dropdown1" ? 'active': '' }}">
                                <i class="{{\Route::currentRouteName()== "admin.dropdown1" ? 'fas fa-circle':
                                'far fa-circle' }} nav-icon"></i>
                                <p>Dropdown 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.dropdown2')}}"
                               class="nav-link {{\Route::currentRouteName()== "admin.dropdown2" ? 'active': '' }}">
                                <i class="{{\Route::currentRouteName()== "admin.dropdown2" ? 'fas':
                                'far' }} fa-circle nav-icon"></i>
                                <p>Dropdown 2</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types"
                       class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Mime types
                            <span class="right badge badge-danger">Important</span>
                        </p>
                    </a>
                </li>
                @if(auth()->guard()->user())
                    <li class="nav-item">
                        <a href="{{route('admin.customers.create')}}" class="nav-link">
                            <p>Ügyfél létrehozása</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.customers.index')}}" class="nav-link">
                            <p>Ügyfél lista</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.posts.create')}}" class="nav-link">
                            <p>Jegyzet létrehozása</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.posts.index')}}" class="nav-link">
                            <p>Jegyzet lista</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

