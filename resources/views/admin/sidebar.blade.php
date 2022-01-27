        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                {{-- <span class="brand-text font-weight-light">{{ $name }}</span> --}}
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ $title }}</a>
                    </div>
                </div> --}}

                <!-- SidebarSearch Form -->
                {{-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Danh mục
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/categories/create') }}" class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Thêm danh mục</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/categories/list') }}" class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh sách danh mục</p>
                                    </a>
                                </li>
                            </ul>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-trailer"></i>
                                <p>
                                    Danh sách sản phẩm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/products/add') }}" class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Thêm sản phẩm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/products/list') }}" class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh sách sản phẩm</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-images"></i>
                                <p>
                                    Slider
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/sliders/add') }}" class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Thêm slider</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/sliders/list') }}" class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh sách sliders</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-user"></i>
                                <p>
                                    Danh sách User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/user/add') }}" class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Thêm User</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('admin/user/list') }}" class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh sách User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-lock"></i>
                                <p>
                                    Quản lí Role
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/user/roles/add') }}" class="nav-link">
                                        <i class="fas fa-plus"></i>
                                        <p>Thêm Role</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('admin/user/roles/list') }}" class="nav-link">
                                        <i class="fas fa-stream"></i>
                                        <p>Danh sách Roles</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/user/payment/list') }}" class="nav-link">
                                <i class="far fa-credit-card"></i>
                                <p>
                                    Quản lí Payment Method
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item d-sm-inline-block">
                            <a href="{{ url('/logout') }}" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
