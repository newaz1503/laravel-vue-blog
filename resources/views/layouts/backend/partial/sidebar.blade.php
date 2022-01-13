<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/admin/dashboard" class="brand-link text-center">
        <span class="brand-text font-weight-light">Blog</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
                <p class="text-white-50">{{Auth::user()->email}}</p>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <router-link to="/admin/dashboard" class="nav-link router-link-active">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Dashboard
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/admin/category" class="nav-link">
                        <i class="nav-icon fa fa-calendar"></i>
                        <p>
                            Category
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/admin/post" class="nav-link">
                        <i class="nav-icon fa fa-newspaper-o"></i>
                        <p>
                            Post
                        </p>
                    </router-link>
                </li>
                <li class="nav-header">SYSTEM</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

