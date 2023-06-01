<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
                <div class="sidebar-brand-icon">
                    <img src="{{asset('admin/assets/img/logo/logo_chot.png')}}" alt="" style="width:100%;">
                </div>
               
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="{{Request::route()->getName() == 'admin.dashboard' ? 'nav-item active' : 'nav-item' }}">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang chủ</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="{{Request::is('admin/category*','admin/brand*','admin/product*','admin/size*') ? 'nav-item active' : 'nav-item'}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-solid fa-shoe-prints"></i>
                    <span>Quản lý mặt hàng</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a  class="{{Request::is('admin/category*') ? 'collapse-item active' : 'collapse-item'}}" 
                            href="{{route('admin.category')}}">QL danh mục</a>
                        <a  class="{{Request::is('admin/brand*') ? 'collapse-item active' : 'collapse-item'}}" 
                            href="{{route('admin.brand')}}">QL nhãn hàng</a>
                        <a class="{{Request::is('admin/product*') ? 'collapse-item active' : 'collapse-item'}}" href="{{route('admin.product')}}">QL sản phẩm</a>
                        <a class="{{Request::is('admin/size*') ? 'collapse-item active' : 'collapse-item'}}" href="{{route('admin.size')}}">QL size giày</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="{{Request::is('admin/vendor*','admin/purchase*') ? 'nav-item active' : 'nav-item'}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-solid fa-file-import"></i>
                    <span>Quản lý nhập kho</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a  class="{{Request::is('admin/vendor*') ? 'collapse-item active' : 'collapse-item'}}" 
                            href="{{route('admin.vendor')}}">QL nhà cung cấp</a>
                        <a  class="{{Request::is('admin/purchase*') ? 'collapse-item active' : 'collapse-item'}}" 
                            href="{{route('admin.purchase')}}">QL nhập kho</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->

            <!-- Nav Item - Charts -->
            <li class="{{Request::is('admin/order*') ? 'nav-item active' : 'nav-item'}}">
                <a class="nav-link" href="{{route('admin.order')}}">
                    <i class="fas fa-solid fa-truck"></i>
                    <span>Quản lý đơn hàng</span></a>
            </li>
            <li class="{{Request::is('admin/user*') ? 'nav-item active' : 'nav-item'}}">
                <a class="nav-link" href="{{route('admin.user')}}">
                    <i class="fas fa-solid fa-users"></i>
                    <span>Quản lý người dùng</span></a>
            </li>
            <!-- quản lý bài viết -->
            <li class="{{Request::is('admin/blog*') ? 'nav-item active' : 'nav-item'}}"> 
                <a class="nav-link" href="{{route('admin.blog')}}">
                    <i class="fas fa-solid fa-newspaper"></i>
                    <span> Quản lý bài viết</span></a>
            </li>
            <!-- quản lý banner -->
            <li class="{{Request::is('admin/banner*') ? 'nav-item active' : 'nav-item'}}">
                <a class="nav-link" href="{{route('admin.banner')}}">
                    <i class="fas fa-solid fa-tv"></i>
                    <span> Quản lý bảng hiệu</span></a>
            </li>
            <!-- Nav Item - Tables -->
            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->

        </ul>

